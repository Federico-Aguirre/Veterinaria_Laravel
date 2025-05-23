FROM php:8.2-cli

# Instala dependencias del sistema y extensiones necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www

# Copia los archivos del proyecto
COPY . .

# Instala las dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Crea carpetas necesarias con permisos adecuados
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expone el puerto
EXPOSE 10000

# Comando por defecto: usar el servidor embebido de Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000






