FROM php:7.4-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y

RUN apt-get install -y git
RUN apt-get install -y zip unzip
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/app
