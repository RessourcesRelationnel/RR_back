FROM php:8.2

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libpq-dev \
    libonig-dev \
    pkg-config \
    libonig5
    
RUN docker-php-ext-install pdo pdo_mysql mbstring
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY .. .
RUN composer install
CMD php artisan serve --host=127.0.0.1 --port=8181
EXPOSE 8181
