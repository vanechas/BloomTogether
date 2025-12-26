#!/bin/sh

echo "Waiting for database..."
sleep 5

php artisan migrate --force || true
php artisan config:clear
php artisan cache:clear

exec php-fpm
