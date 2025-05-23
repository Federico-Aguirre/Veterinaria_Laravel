FROM php:8.2-fpm

# Instalamos extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalamos Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN ls -la storage/logs && cat storage/logs/laravel.log || echo "No hay logs"

# Exponemos el puerto 10000 que usaremos para artisan serve
EXPOSE 10000

# Arrancamos el servidor de desarrollo Laravel en el puerto 10000, accesible desde afuera
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]



