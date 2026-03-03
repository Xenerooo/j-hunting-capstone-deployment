#!/bin/bash

# Cache Laravel config for performance
php artisan config:cache
php artisan route:cache
# php artisan view:cache

# Run database migrations automatically on every deploy
php artisan migrate --force

# Start Apache
apache2-foreground