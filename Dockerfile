FROM php:8.2-apache
RUN docker-php-ext-install mysqli
COPY /v2 /var/www/html

EXPOSE 80

#docker build - t codigos_postales_php .