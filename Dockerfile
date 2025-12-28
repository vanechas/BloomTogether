FROM php:8.2-cli

WORKDIR /app

# Install system deps + Node
RUN apt-get update && apt-get install -y \
    git unzip zip curl nodejs npm \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Permissions
RUN chmod -R 775 storage bootstrap/cache

# IMPORTANT: use Railway port
CMD php artisan serve --host=0.0.0.0 --port=${PORT}
