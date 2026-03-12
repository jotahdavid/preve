#!/bin/sh
set -e

if [ "$CONTAINER_ROLE" == "app" ]; then
    if [ "$APP_ENV" == "local" ]; then
        echo "📦 [APP] Installing packages..."
        if [ ! -f vendor/autoload.php ] || [ composer.lock -nt vendor/autoload.php ]; then
            composer install --no-interaction
        else
            echo "📦 [APP] Dependencies already installed, skipping composer install."
        fi
    fi

    echo "🚀 [APP] Running startup tasks..."

    echo "📦 Running migrations..."
    php artisan migrate --force

    echo "🧭 Generating Wayfinder navigation..."
    php artisan wayfinder:generate --with-form

    if [ "$APP_ENV" != "local" ]; then
        echo "🔥 Caching configuration for Production..."
        php artisan config:cache
        php artisan route:cache
        php artisan view:cache
    else
        echo "🧹 Clearing caches for Local Development..."
        php artisan config:clear
        php artisan route:clear
        php artisan view:clear
    fi
fi
