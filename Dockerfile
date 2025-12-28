# ===============================
# Stage 1: Node for Vite (Build assets or Dev server)
# ===============================
FROM node:18 AS vite

WORKDIR /app

# Copy package files
COPY package.json package-lock.json ./
RUN npm ci

# Copy resources
COPY resources ./resources
COPY vite.config.* ./

# Expose Vite dev server port
EXPOSE 5173

# Run production build by default
ARG APP_ENV=production
RUN if [ "$APP_ENV" = "production" ]; then npm run build; fi

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

# Composer binary
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel app
COPY . .

# Copy built assets (for production)
COPY --from=vite /app/public/build /app/public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose Laravel port
EXPOSE 8000

# Command to run Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
