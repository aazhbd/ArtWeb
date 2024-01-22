FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    sudo openssh-server zlib1g-dev libzip-dev unzip default-mysql-client

RUN docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod actions
RUN a2enmod headers
RUN a2enmod cgi
RUN a2enmod expires
RUN a2enmod mpm_prefork
RUN a2enmod rewrite
RUN a2enmod ssl
RUN a2dismod mpm_event

ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /var/www/html/
COPY . .
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

RUN composer dump-autoload --optimize
