# Chọn image PHP có sẵn
FROM php:8.2-fpm

# Cài các extension cần thiết
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install zip pdo pdo_mysql

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo thư mục code
WORKDIR /var/www

# Copy toàn bộ mã nguồn vào container
COPY . .

# Cài thư viện PHP
RUN composer install --no-dev --optimize-autoloader

# Copy file .env nếu chưa có
COPY .env.example .env

# Laravel permission
RUN chmod -R 775 storage bootstrap/cache

# EXPOSE PORT
EXPOSE 8080

# Lệnh chạy Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
