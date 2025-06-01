# Используем официальный PHP-образ с Apache
FROM php:8.2-apache

# Устанавливаем системные зависимости и расширения PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Включаем mod_rewrite для Laravel маршрутов
RUN a2enmod rewrite

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Копируем проект внутрь контейнера
COPY . /var/www/html

# Задаём рабочую директорию
WORKDIR /var/www/html

# Устанавливаем зависимости Laravel
RUN composer install --no-dev --optimize-autoloader

# Генерируем ключ приложения
RUN php artisan key:generate

# Даём нужные права для кэшей
RUN chown -R www-data:www-data storage bootstrap/cache

# Указываем порт, который будет использовать Apache
EXPOSE 80
