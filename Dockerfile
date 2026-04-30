FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    zip unzip git \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install sockets

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ./www /var/www/html

CMD ["php-fpm"]