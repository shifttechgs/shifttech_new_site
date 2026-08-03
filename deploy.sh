#!/usr/bin/env bash
#
# Production deploy, run on the pod by the hosting panel.
#
# Panel "Deploy Command" should be exactly:
#     cd /app && git fetch origin master && git reset --hard origin/master && bash deploy.sh
#
# The fetch/reset is repeated there so that an update to this script itself is
# picked up before it runs.
#
set -euo pipefail

APP_DIR="${APP_DIR:-/app}"
cd "$APP_DIR"

echo "==> Deploying in $APP_DIR as $(id -un)"

# Previous deploys ended with `chown -R application:application /app`, so .git
# can end up owned by a different user than the one running the deploy. Git
# then aborts with "detected dubious ownership" and, because the panel command
# is && chained, every later step is skipped silently.
git config --global --add safe.directory "$APP_DIR" 2>/dev/null || true

echo "==> Fetching origin/master"
git fetch origin master
# reset rather than pull: a pull fails on any local edit or diverged history
# and leaves the pod serving stale code.
git reset --hard origin/master
git --no-pager log --oneline -1

echo "==> composer install"
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Build the caches rather than only clearing them. Clearing alone left the pod
# re-parsing every config file, re-registering every route and recompiling every
# Blade template on each request. Measured server processing time before this
# was 0.59-0.70s per page (TTFB minus connection setup).
#
# These three are used instead of `optimize` because `optimize` also runs
# cache:clear, which needs the `cache` table (CACHE_STORE=database) and would
# abort the deploy if that table is missing. Each command clears its own cache
# before rebuilding, so no separate clear step is needed.
#
# config:cache runs before the migration so that migrate reads freshly cached
# config rather than a stale file.
echo "==> Rebuilding config, route and view caches"
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Schema changes had no automatic path to the pod before this: every migration
# since the app went live needed someone to remember to run it by hand, and a
# forgotten one shows up as a 500 on whichever page reads the new column.
# --force is required because the pod is APP_ENV=production, and it is a no-op
# when nothing is pending.
#
# set -euo pipefail means a failed migration stops the deploy here, before the
# chown and before anything reports success. That is deliberate. A half-applied
# schema should fail loudly rather than quietly serve broken pages.
echo "==> Running migrations"
php artisan migrate --force

echo "==> Fixing ownership"
chown -R application:application "$APP_DIR"

echo "==> Deployed $(git rev-parse --short HEAD) successfully"
