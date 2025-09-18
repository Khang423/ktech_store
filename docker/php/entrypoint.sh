#!/bin/sh
set -e

# Cài composer dependencies (nếu chưa có vendor)
if [ ! -d "vendor" ]; then
  composer install --no-interaction --prefer-dist
fi

# Laravel optimize
php artisan config:clear
php artisan migrate --force || true

# Chạy php-fpm
exec php-fpm
