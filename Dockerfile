# Usar la imagen oficial PHP con FPM (FastCGI Process Manager)
FROM php:8.2-cli

# Instalar dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Instalar Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de la app
COPY . .

# Instalar dependencias PHP con Composer
RUN composer install --no-dev --optimize-autoloader

# Dar permisos correctos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 10000

# CMD para ejecutar PHP-FPM
CMD ["php-fpm"]
