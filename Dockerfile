FROM unit:1.34.1-php8.3

RUN apt update && apt install -y \
    curl unzip git libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pcntl opcache pdo pdo_mysql intl zip gd exif ftp bcmath calendar \
    && pecl install redis \
    && docker-php-ext-enable redis

RUN echo "opcache.enable=1" > /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.jit=tracing" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.jit_buffer_size=256M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "memory_limit=512M" > /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize=64M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size=64M" >> /usr/local/etc/php/conf.d/custom.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

# Create full Laravel storage structure (logs dir is required for Laravel logging)
RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache

COPY . .

# Fix ownership and permissions for Unit (runs as unit:unit)
RUN chown -R unit:unit storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN composer install --prefer-dist --optimize-autoloader --no-interaction

# Re-apply permissions after composer (in case any artisan/cache files were created)
RUN chown -R unit:unit storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN php artisan storage:link  

COPY unit.json /docker-entrypoint.d/unit.json

EXPOSE 80

CMD ["unitd", "--no-daemon"]