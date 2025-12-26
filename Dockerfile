FROM php:8.2-apache

# Fix ServerName warning (optional but clean)
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Enable rewrite for Laravel
RUN a2enmod rewrite

# Set Apache DocumentRoot to Laravel public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/000-default.conf

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html
COPY . .

# Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
