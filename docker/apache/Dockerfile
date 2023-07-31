FROM php:8.1-apache

WORKDIR /workspace

RUN apt update
RUN apt install -y \
    zip \
    curl \
    unzip \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++

RUN docker-php-ext-install \
    bz2 \
    intl \
    bcmath \
    opcache \
    calendar \
    pdo_mysql \
    mysqli

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./src /workspace

RUN a2enmod rewrite headers
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer self-update

ARG uid
ARG user
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user
RUN composer install

EXPOSE 80
