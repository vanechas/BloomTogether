# 

FROM php:8.2-apache

RUN echo "========== THIS IS THE REAL DOCKERFILE ==========" \
 && apachectl -M

CMD ["apache2-foreground"]
