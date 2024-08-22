FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    gnupg \
    && docker-php-ext-install intl

RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY ./website /var/www/html

RUN composer install --no-scripts --no-autoloader

RUN npm install && npm run build

RUN composer dump-autoload --optimize
