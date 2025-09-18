#!/bin/sh
set -e

# Cài dependency nếu chưa có
if [ ! -d "vendor" ]; then
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Clear & cache để Laravel chạy ổn định
php artisan config:clear
# php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Chạy migrate mỗi lần start (an toàn vì Laravel sẽ bỏ qua migration đã chạy)
php artisan migrate --force

# Chạy seed chỉ 1 lần duy nhất (dùng file flag)
if [ ! -f /var/www/.seeded ]; then
  echo "Seeding initial data..."
  php artisan db:seed --class=InsertAddressSeeder
  php artisan db:seed --class=DatabaseSeeder
  touch /var/www/.seeded
else
  echo "Seed already done, skip."
fi

# Cuối cùng, chạy php-fpm
exec php-fpm
