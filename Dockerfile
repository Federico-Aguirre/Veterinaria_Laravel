FROM php:8.2-cli

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Setea directorio de trabajo
WORKDIR /var/www

# Copia archivos del proyecto
COPY . .

# Instala dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Prepara permisos
RUN mkdir -p storage/framework/{sessions,views,cache} && chmod -R 775 storage bootstrap/cache

# Expone el puerto
EXPOSE 8000

# Inicia Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
