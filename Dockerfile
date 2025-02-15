# Imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia los archivos del proyecto
WORKDIR /var/www/html
COPY . .

# Otorga permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto 80
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
