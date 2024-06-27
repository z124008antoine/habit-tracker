FROM php:8.0-apache
WORKDIR /var/www/html

# Install pdo_mysql
RUN docker-php-ext-install pdo_mysql

COPY ./public /var/www/html
EXPOSE 80