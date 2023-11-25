##############################################
# Felipe Pessoa				     #
# LAMP PHP 8.2				     #
##############################################

FROM php:8.2-apache

RUN apt-get update

RUN apt-get install -y \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config zlib1g-dev \
    libpng-dev \
    libicu-dev \
    g++ \
    libxml2-dev \
    libonig-dev \
    libzip-dev \
    libmagickwand-dev \
    libmemcached-dev \
    libpq-dev \
    vim

RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    mbstring \
    curl \
    zip \
    intl \
    simplexml \
    soap \
    pgsql \
    pdo_pgsql \
    bcmath

RUN pecl install \
    imagick \
    igbinary \
    redis \
    swoole \
    memcached \
    pcov \
    xdebug

RUN docker-php-ext-enable imagick \
    igbinary \
    redis \
    swoole \
    memcached \
    pcov \
    xdebug

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer



COPY ./build/config/php.ini /usr/local/etc/php/php.ini

RUN a2enmod rewrite

RUN a2enmod headers

RUN rm /etc/apache2/apache2.conf

COPY ./build/config/apache2.conf /etc/apache2/apache2.conf

RUN apt-get update
RUN apt-get install -y --no-install-recommends git zip

RUN apt-get update \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

WORKDIR /var/www/html/

EXPOSE 80
