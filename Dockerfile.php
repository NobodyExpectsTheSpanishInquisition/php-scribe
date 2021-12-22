ARG PHP_VERSION
FROM php:$PHP_VERSION

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer creates=/usr/local/bin/composer warn=no

RUN pecl install xdebug

ARG PATH
WORKDIR $PATH

COPY ./php ./php
