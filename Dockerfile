# ---------- Stage 1: Build frontend ----------
FROM node:18-alpine AS frontend

WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY resources resources
COPY vite.config.js .
RUN npm run build

# ---------- Stage 2: PHP ----------
FROM php:8.2-fpm

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev nginx \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app
COPY . .

# Copy built assets
COPY --from=frontend /app/public/build /app/public/build

RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 775 storage bootstrap/cache

# Nginx config
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 8000

CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]
