#!/bin/bash
set -e

echo "=========================================="
echo "Starting Laravel 12 (Plain)"
echo "=========================================="
echo "PHP Version: $(php -v | head -n 1)"
echo "Environment: ${APP_ENV:-production}"
echo "=========================================="

# Create required directories
echo "Setting up directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache

chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Wait for database
if [ ! -z "$DB_HOST" ]; then
    echo "Waiting for database connection..."
    max_attempts=30
    attempt=0
    until php artisan db:show > /dev/null 2>&1 || [ $attempt -eq $max_attempts ]; do
        attempt=$((attempt + 1))
        echo "Database not ready, waiting... (${attempt}/${max_attempts})"
        sleep 2
    done

    if [ $attempt -eq $max_attempts ]; then
        echo "⚠ Warning: Could not connect to database after ${max_attempts} attempts"
    else
        echo "✓ Database connection established"
    fi
fi

# Run migrations
echo "Running database migrations..."
php artisan migrate --force --no-interaction || {
    echo "⚠ Migrations failed or no migrations to run"
}

# Optimize
echo "Optimizing application..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction
php artisan event:cache --no-interaction

# Storage link
if [ ! -L "public/storage" ]; then
    echo "Creating storage symbolic link..."
    php artisan storage:link || echo "Storage link already exists"
fi

# Queue worker (optional)
if [ "${QUEUE_WORKER:-false}" = "true" ]; then
    echo "Starting queue worker..."
    php artisan queue:work --daemon --tries=3 --timeout=90 > /dev/null 2>&1 &
    echo "✓ Queue worker started"
fi

echo "=========================================="
echo "✓ Application ready"
echo "Listening on: 0.0.0.0:8000"
echo "=========================================="

exec php artisan serve --host=0.0.0.0 --port=8000