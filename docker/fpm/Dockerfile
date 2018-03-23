FROM bitnami/php-fpm:latest

RUN apt-get update && \
    apt-get install -y wget apt-transport-https lsb-release ca-certificates libpng-dev libxml2-dev && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list
RUN apt-get install -y zip unzip

RUN apt-get install -y libmcrypt-dev mysql-client libmagickwand-dev php7.2-devel --no-install-recommends && \
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
