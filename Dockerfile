# ---------- Frontend build ----------
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources ./resources
COPY vite.config.js ./
RUN npm run build


# ---------- Backend ----------
FROM php:8.2-fpm-alpine

WORKDIR /app

# System deps
RUN apk add --no-cache \
    git \
    zip \
    unzip \
    libpng-dev \
    libxml2-dev

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel app
COPY . .

# Copy built Vite assets
COPY --from=frontend /app/public/build ./public/build

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
