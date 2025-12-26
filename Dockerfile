# --- Stage 1: Build Assets (Node.js) ---
FROM node:18-alpine as build_assets

WORKDIR /app

COPY . .

# Install dependencies Node dan build aset (Vite)
RUN npm install
RUN npm run build

# --- Stage 2: PHP Application ---
FROM php:8.2-cli

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Copy seluruh file project
COPY . .

# Copy hasil build aset (CSS/JS) dari Stage 1 ke Stage 2
COPY --from=build_assets /app/public/build /app/public/build

# Install PHP dependencies
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && mv composer.phar /usr/local/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]