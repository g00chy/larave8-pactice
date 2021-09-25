FROM php:8.0-fpm-alpine
COPY php.ini /usr/local/etc/php/

RUN apk add --no-cache zip zlib-dev mariadb-client libzip-dev	\
  && docker-php-ext-install zip pdo_mysql

#Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin


WORKDIR /var/www

RUN composer global require "laravel/installer"
