# --- Same NGINX Unit 1.34.1, rebuilt on the latest patched PHP 8.3 (PHP2Shell fix) ---
FROM php:8.3-cli-bookworm AS unit-build
RUN apt-get update && apt-get install -y --no-install-recommends \
        ca-certificates git build-essential libssl-dev libpcre2-dev pkg-config \
    && git clone --depth 1 -b 1.34.1 https://github.com/nginx/unit /usr/src/unit \
    && cd /usr/src/unit \
    && ./configure --prefix=/usr --statedir=/var/lib/unit \
        --control=unix:/var/run/control.unit.sock --runstatedir=/var/run \
        --pid=/var/run/unit.pid --logdir=/var/log --log=/dev/stdout \
        --tmpdir=/var/tmp --user=unit --group=unit --openssl \
        --modulesdir=/usr/lib/unit/modules \
    && make -j"$(nproc)" unitd \
    && install -pm755 build/sbin/unitd /usr/sbin/unitd \
    && ./configure php \
    && make -j"$(nproc)" php-install

FROM php:8.3-cli-bookworm
COPY --from=unit-build /usr/sbin/unitd /usr/sbin/unitd
COPY --from=unit-build /usr/lib/unit /usr/lib/unit
RUN groupadd --system unit \
    && useradd --system --gid unit --no-create-home --home /nonexistent --shell /bin/false unit \
    && mkdir -p /var/lib/unit
STOPSIGNAL SIGTERM
# --- original Dockerfile continues unchanged below ---

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

# Copy application
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

# Unit runs as `unit:unit`
RUN chown -R unit:unit /var/www/html \
    && chmod -R 775 storage bootstrap/cache \
    && chmod -R 775 storage/app/public \
    && touch storage/logs/laravel.log \
    && chown unit:unit storage/logs/laravel.log \
    && chmod 664 storage/logs/laravel.log

# Copy Unit configuration
COPY unit.json /docker-entrypoint.d/unit.json

EXPOSE 80

CMD sh -c "\
    chown -R unit:unit /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && \
    touch /var/www/html/storage/logs/laravel.log && \
    chown unit:unit /var/www/html/storage/logs/laravel.log && \
    chmod 664 /var/www/html/storage/logs/laravel.log && \
    unitd --no-daemon --control unix:/var/run/control.unit.sock & \
    sleep 2 && \
    curl -s -X PUT --data-binary @/docker-entrypoint.d/unit.json \
        --unix-socket /var/run/control.unit.sock \
        http://localhost/config && \
    echo 'Unit config loaded successfully' && \
    wait"
