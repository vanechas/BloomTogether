FROM php:8.2-apache

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]
