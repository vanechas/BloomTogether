# ===============================
# Stage 1: Build Vite assets
# ===============================
FROM node:18 AS vite

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY vite.config.* ./

RUN npm run build

# ===============================
# Stage 2: Laravel App (CLI)
# ===============================
FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

COPY --from=vite /app/public/build /app/public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN chmod -R 775 storage bootstrap/cache

# IMPORTANT: Railway provides PORT automatically
CMD sh -c "php artisan serve --host=0.0.0.0 --port=$PORT"
