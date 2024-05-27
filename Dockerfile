FROM php:8.2

ENV COMPOSER_ALLOW_SUPERUSER=1

# Install system dependencies
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libpq-dev \
    libonig-dev \
    pkg-config \
    libonig5

# Install PHP extensions
RUN docker-php-ext-install pdo mbstring

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy application code
COPY .. .

# Debug: List files in /app directory
RUN ls -la /app
RUN ls -la /app | grep composer.json

# Ensure composer.json exists
RUN if [ ! -f /app/composer.json ]; then echo "composer.json not found!"; exit 1; fi

# Install PHP dependencies
RUN composer install

# Expose port and start the application
CMD php artisan serve --host=127.0.0.1 --port=8181
EXPOSE 8181
