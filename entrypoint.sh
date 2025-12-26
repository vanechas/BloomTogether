#!/bin/sh

echo "Waiting for database..."

sleep 5

php artisan key:generate --force || true
php artisan migrate --force
php artisan config:clear
php artisan cache:clear

exec apache2-foreground
