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

# Clear only the caches that do not touch the database. `optimize:clear` also
# runs cache:clear, which needs the `cache` table (CACHE_STORE=database) and
# would abort the deploy if that table is missing.
echo "==> Clearing config, route and view caches"
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "==> Fixing ownership"
chown -R application:application "$APP_DIR"

echo "==> Deployed $(git rev-parse --short HEAD) successfully"
