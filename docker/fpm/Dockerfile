FROM php:7-fpm

RUN apt-get update && \
    apt-get install -y wget apt-transport-https lsb-release ca-certificates libpng-dev libxml2-dev && \
    apt-get update

RUN docker-php-ext-install mysqli && \
    docker-php-ext-install mbstring && \
    docker-php-ext-install xml && \
    docker-php-ext-install gd

RUN apt-get install -y zip unzip

RUN apt-get update && apt-get install -y libmcrypt-dev \
    mysql-client libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install mcrypt pdo_mysql

# install npm
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash && \
    apt-get install -y nodejs

# install yarn
RUN npm install -g yarn

# install composer
RUN apt-get install -y curl php-cli git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /code
