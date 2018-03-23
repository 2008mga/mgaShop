FROM php:7-fpm

RUN apt-get update && \
    apt-get install -y wget apt-transport-https lsb-release ca-certificates libpng-dev libxml2-dev && \
    apt-get update
RUN apt-get install -y zip unzip && \
    apt-get update

RUN apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*  && \
    curl -L https://pecl.php.net/get/imagick-3.4.3.tgz >> /usr/src/php7/ext/imagick.tgz && \
    tar -xf /usr/src/php7/ext/imagick.tgz -C /usr/src/php7/ext/ && \
    rm /usr/src/php7/ext/imagick.tgz

RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client imagemagick libmagickwand-dev --no-install-recommends && \
    pecl install imagick mcrypt-1.0.1
RUN docker-php-ext-install mysqli mbstring xml imagick-3.4.3 gd mcrypt pdo_mysql

# install npm
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash && \
    apt-get install -y nodejs

# install yarn
RUN npm install -g yarn

# install composer
RUN apt-get install -y curl php-cli git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /code
