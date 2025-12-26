# =========================
# Stage 1 — Vendor
# =========================
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-scripts

# =========================
# Stage 2 — App
# =========================
FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql

# Copy full app
COPY . .

# Copy vendor
COPY --from=vendor /app/vendor ./vendor

# Permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
