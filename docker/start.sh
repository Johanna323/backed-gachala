#!/bin/bash

# Wait for database to be ready
echo "Waiting for database connection..."
while ! php artisan db:monitor --timeout=1 2>/dev/null; do
    sleep 1
done

# Run migrations
php artisan migrate --force

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Start Apache
apache2-foreground 