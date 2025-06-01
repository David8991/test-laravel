FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    sqlite3 libsqlite3-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_sqlite zip mbstring xml

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
WORKDIR /var/www/html

# Копируем .env, если нужно
RUN cp .env.example .env || true

# ВРЕМЕННО — без --no-dev, чтобы видеть ошибку
RUN composer install --optimize-autoloader

RUN php artisan key:generate || true
RUN php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
