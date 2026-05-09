FROM unit:1.34.1-php8.3

# Install system dependencies + PHP extensions
RUN apt update && apt install -y \
    curl \
    unzip \
    git \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libssl-dev \
    rsync \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pcntl \
        opcache \
        pdo \
        pdo_mysql \
        intl \
        zip \
        gd \
        exif \
        ftp \
        bcmath \
        calendar \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt clean \
    && rm -rf /var/lib/apt/lists/*

# PHP configuration
RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.jit=tracing"; \
    echo "opcache.jit_buffer_size=256M"; \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=64M"; \
    echo "post_max_size=64M"; \
    echo "max_execution_time=300"; \
} > /usr/local/etc/php/conf.d/custom.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

# Copy application first
COPY . .

# Install dependencies
RUN composer install \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction \
    --no-dev

# Create required Laravel directories
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    storage/app/public \
    bootstrap/cache

# IMPORTANT:
# Unit runs as `unit:unit`, NOT www-data
RUN chown -R unit:unit /var/www/html \
    && chmod -R 775 storage bootstrap/cache \
    && chmod -R 775 storage/app/public \
    && touch storage/logs/laravel.log \
    && chown unit:unit storage/logs/laravel.log \
    && chmod 664 storage/logs/laravel.log

# Copy Unit configuration
COPY unit.json /docker-entrypoint.d/unit.json

EXPOSE 80

# Runtime permission fix for Coolify mounted volumes
CMD sh -c "\
    chown -R unit:unit /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && \
    touch /var/www/html/storage/logs/laravel.log && \
    chown unit:unit /var/www/html/storage/logs/laravel.log && \
    chmod 664 /var/www/html/storage/logs/laravel.log && \
    unitd --no-daemon"