# -----------------------------
# Base PHP image (PHP-FPM only)
# -----------------------------
FROM php:8.2-fpm

# -----------------------------
# Install system dependencies
# -----------------------------
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# -----------------------------
# Install PHP extensions
# -----------------------------
RUN docker-php-ext-install pdo pdo_mysql

# -----------------------------
# Install Composer
# -----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -----------------------------
# Set working directory
# -----------------------------
WORKDIR /var/www

# -----------------------------
# Copy composer files first
# (better Docker layer caching)
# -----------------------------
COPY composer.json composer.lock ./

# -----------------------------
# Install PHP dependencies
# -----------------------------
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# -----------------------------
# Copy full project
# -----------------------------
COPY . .

# -----------------------------
# Install Node deps & build Vite
# -----------------------------
RUN npm install
RUN npm run build

# -----------------------------
# Laravel permissions
# -----------------------------
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# -----------------------------
# Expose PHP-FPM port
# -----------------------------
EXPOSE 9000

# -----------------------------
# Start PHP-FPM
# -----------------------------
CMD ["php-fpm"]
