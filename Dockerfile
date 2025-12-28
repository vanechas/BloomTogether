FROM php:8.2-apache

WORKDIR /var/www/html

# Enable Apache rewrite
RUN a2enmod rewrite

# Install system deps + Node
RUN apt-get update && apt-get install -y \
    git unzip zip curl nodejs npm \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project
COPY . .

# Laravel public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# Install deps
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Permissions
RUN chmod -R 777 storage bootstrap/cache

# Apache listens on Railway port
ENV PORT=80
EXPOSE 80
