FROM bitnami/php-fpm:latest

RUN apt-get update && \
    apt-get install -y wget apt-transport-https lsb-release ca-certificates libpng-dev libxml2-dev && \
    apt-get update
RUN apt-get install -y zip unzip && \
    apt-get update
    #install Imagemagick & PHP Imagick ext
RUN apt-get update && apt-get install -y \
        libmagickwand-dev --no-install-recommends

RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client libmagickwand-dev --no-install-recommends && \
    pecl install imagick mcrypt-1.0.1
RUN docker-php-ext-install mysqli mbstring xml gd mcrypt pdo_mysql

# install npm
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash && \
    apt-get install -y nodejs

# install yarn
RUN npm install -g yarn

# install composer
RUN apt-get install -y curl php-cli git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /code
