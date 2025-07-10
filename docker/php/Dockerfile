# FROM php:8.3-fpm

# # Cài các extension cần thiết cho Laravel
# RUN apt-get update && apt-get install -y \
# git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
# && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# # Cài Composer từ official image
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
FROM php:8.3-fpm

# Cài các thư viện cần thiết cho Laravel + WebP support
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    libjpeg-dev libwebp-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
