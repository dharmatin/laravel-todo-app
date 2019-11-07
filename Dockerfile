FROM php:7.2-fpm
MAINTAINER dharmatin@gmail.com
COPY composer.lock composer.json /var/www/
WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    mariadb-client-10.3 \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    telnet

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
    
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www

COPY --chown=www:www . /var/www

USER www

EXPOSE 9000
CMD ["sh", "-c", "php artisan key:generate && php artisan config:cache && php artisan migrate && php-fpm"]