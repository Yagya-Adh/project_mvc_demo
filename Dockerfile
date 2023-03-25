FROM php:8.1.0-apache

# Install required packages
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip gd

#Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

EXPOSE 80



