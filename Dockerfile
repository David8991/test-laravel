FROM php:8.2-apache

# Установка системных зависимостей и PHP-расширений, включая SQLite
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite zip mbstring xml

# Включаем Apache модуль rewrite
RUN a2enmod rewrite

# Копируем Composer из официального образа
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Копируем проект в контейнер
COPY . /var/www/html

WORKDIR /var/www/html

# Установка PHP-зависимостей проекта
RUN composer install --no-dev --optimize-autoloader

# Генерируем ключ приложения
RUN php artisan key:generate

# Создаем пустую SQLite базу, если ее нет (можно не обязательно, если уже есть)
RUN php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"

# Правильно задаем права на папки для Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Открываем порт 80 для Apache
EXPOSE 80
