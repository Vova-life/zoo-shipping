FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev \
    && docker-php-ext-install zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Копіюємо конфігурацію
COPY ../../backend/composer.json ./

# Копіюємо УСІ папки (додали tests!)
COPY ../../backend/src ./src
COPY ../../backend/config ./config
COPY ../../backend/public ./public
COPY ../../backend/tests ./tests

# Встановлюємо залежності (включаючи PHPUnit)
RUN composer install --no-scripts --no-autoloader || true

RUN chown -R www-data:www-data /var/www/html