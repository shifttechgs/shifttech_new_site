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

# public/build is gitignored (standard practice: compiled assets don't belong
# in version control), so the pod has no manifest.json until this runs. Without
# it, every @vite(...) call in a Blade view throws "Vite manifest not found" —
# 500 on any page that isn't a Filament panel, since Filament ships its own
# compiled assets and never touches this app's manifest.
echo "==> npm install && build"
npm ci
npm run build

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

# Seeds the admin user, the service catalogue, and the real CRM records
# (clients, quotes, invoices, payments) carried in the encrypted payload at
# database/seeders/data/crm-payload.enc.
#
# Safe on every deploy: each row is keyed by its business ID (CLI-, QUO-, INV-,
# PAY-) and skipped when already present, and nothing is ever updated or
# deleted. A record edited in the panel is not clobbered by the next deploy.
#
# The payload is ciphertext because this repository is public. Decryption needs
# CRM_SEED_KEY in the pod's .env — without it the CRM records are skipped with a
# warning and only the defaults are seeded. A key that is present but wrong is a
# hard failure, which stops the deploy here rather than reporting success over a
# database that received nothing.
echo "==> Seeding"
php artisan db:seed --force

echo "==> Fixing ownership"
chown -R application:application "$APP_DIR"

# Without this the deploy is a no-op for anything PHP.
#
# opcache runs with validate_timestamps=0, so PHP never re-reads a file whose
# contents changed. Confirmed on 3 Aug 2026: the correct commit was on disk,
# the new controller was physically present, and Apache still served the old
# output until a reload. Every PHP change before this needed a reload that
# nothing in the pipeline performed.
#
# opcache_reset() from the CLI cannot fix it: CLI and Apache hold separate
# opcode caches. Only reloading the web server clears the one that serves
# visitors.
#
# The variants differ by image, so try each. `|| true` keeps set -e from
# aborting on the ones that do not apply, and the failure is reported rather
# than passed off as success.
echo "==> Reloading web server to clear opcache"
if apachectl -k graceful 2>/dev/null \
    || systemctl reload apache2 2>/dev/null \
    || service apache2 reload 2>/dev/null \
    || kill -USR2 "$(cat /run/php-fpm.pid 2>/dev/null)" 2>/dev/null; then
    echo "    reloaded"
else
    echo "    WARNING: could not reload. New PHP code is on disk but Apache is"
    echo "    still serving cached bytecode. Reload it by hand or this deploy"
    echo "    has not taken effect."
fi

echo "==> Deployed $(git rev-parse --short HEAD) successfully"
