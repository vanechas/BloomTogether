# =========================
# Stage 1 — Build vendor
# =========================
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# =========================
# Stage 2 — App runtime
# =========================
FROM php:8.2-cli

WORKDIR /app

# System deps
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy app source
COPY . .

# Copy vendor from stage 1
COPY --from=vendor /app/vendor ./vendor

# Permissions
RUN chmod -R 775 storage bootstrap/cache

# Clear Laravel cache AFTER vendor exists
RUN php artisan config:clear \
 && php artisan cache:clear

# Railway expects PORT
EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
