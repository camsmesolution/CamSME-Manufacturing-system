#!/bin/sh

# Fail on any error
set -e

echo "🚀 Deploy Script Started"

# DEBUG: Check Nginx Config
echo "🔍 Checking Nginx Configuration..."
if [ -d "/etc/nginx" ]; then
    echo "Files in /etc/nginx:"
    ls -la /etc/nginx
else
    echo "❌ /etc/nginx directory does not exist!"
fi


# 1. Run Migrations & Seeds
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "📦 Running Migrations..."
    php artisan migrate --force
fi

if [ "$RUN_SEED" = "true" ]; then
    echo "🌱 Seeding Database..."
    php artisan db:seed --force
fi

rm -rf public/storage
php artisan storage:link
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache public/storage


# 2. Clear/Cache Configs
echo "🧹 Optimizing Cache..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Starting Server (Handled by image)
echo "✅ Deployment Tasks Complete."


