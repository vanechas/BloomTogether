# ===============================
# Stage 1: Node for Vite (Build assets)
# ===============================
FROM node:18 AS vite

WORKDIR /app

# Copy package files
COPY package.json package-lock.json ./
RUN npm ci

# Copy Vite + Laravel resources (IMPORTANT)
COPY resources ./resources
COPY public ./public
COPY vite.config.* ./

# Build assets (production)
RUN npm run build


# ===============================
# Stage 2: Laravel App
# ===============================
FROM php:8.2-fpm AS laravel

WORKDIR /app

# Install PHP system dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel app
COPY . .

# Copy built Vite assets
COPY --from=vite /app/public/build /app/public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose Laravel port
EXPOSE 8000

# Run Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
