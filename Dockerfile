# Usa una imagen base oficial de PHP con FPM
FROM php:8.2-fpm

# Instala dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpq-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define el directorio de trabajo
WORKDIR /var/www

# Copia todo el código al contenedor
COPY . .

# Instala dependencias de PHP sin las de desarrollo
RUN composer install --no-dev --optimize-autoloader

# Da permisos adecuados a Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Expone el puerto que usará Artisan Serve
EXPOSE 8000

# Comando que inicia Laravel al levantar el contenedor
CMD php artisan serve --host=0.0.0.0 --port=8000