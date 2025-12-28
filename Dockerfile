FROM php:8.2-cli

WORKDIR /app

# Install system + Node
RUN apt-get update && apt-get install -y \
    git unzip zip curl nodejs npm \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app
COPY . .

# Install deps
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Permissions
RUN chmod -R 777 storage bootstrap/cache

# 🚨 IMPORTANT: use PHP built-in server (NOT artisan)
CMD php -S 0.0.0.0:${PORT} -t public public/index.php
