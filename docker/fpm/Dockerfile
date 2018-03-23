FROM php:7.2-fpm

RUN apt-get update && \
    apt-get install -y wget apt-transport-https lsb-release ca-certificates libpng-dev libxml2-dev && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list
RUN apt-get install -y zip unzip

RUN apt-get install -y  libmcrypt-dev mysql-client libmagickwand-dev build-essential autoconf --no-install-recommends && \
    apt-get update && \
    pecl install imagick
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install xml
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install gd

# install composer
RUN apt-get install -y curl git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /code
