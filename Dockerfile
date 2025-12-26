# 1. Use official PHP + Apache image
FROM php:8.2-apache

# 2. Enable Apache rewrite (required for Laravel routing)
RUN a2enmod rewrite

# 3. Change Apache DocumentRoot to Laravel /public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/000-default.conf

# 4. Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# 5. Set working directory
WORKDIR /var/www/html

# 6. Copy Laravel files
COPY . .

# 7. Set permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 8. Expose Apache port
EXPOSE 80

# 9. Start Apache
CMD ["apache2-foreground"]