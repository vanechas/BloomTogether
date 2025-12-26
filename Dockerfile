# ========================
# Stage 1: Composer
# ========================
FROM composer:2 AS composer

WORKDIR /app

# Copy SELURUH source code dulu (termasuk artisan)
COPY . .

# Baru install dependency
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-progress


# ========================
# Stage 2: PHP-FPM
# ========================
FROM php:8.2-fpm

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

COPY . .
COPY --from=composer /app/vendor /app/vendor

RUN chown -R www-data:www-data /app \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
