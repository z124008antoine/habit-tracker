FROM php:8.0-apache
WORKDIR /var/www/html

# Install mysqli
RUN docker-php-ext-install mysqli

COPY ./public /var/www/html
EXPOSE 80