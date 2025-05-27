FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first
COPY composer.json composer.lock ./

# Install composer dependencies
RUN composer install --no-scripts

# Copy existing application directory
COPY . .

# Remove default Nginx configuration
RUN rm /etc/nginx/sites-enabled/default /etc/nginx/sites-available/default

# Copy nginx configuration
COPY docker/nginx/app.conf /etc/nginx/sites-available/
RUN ln -s /etc/nginx/sites-available/app.conf /etc/nginx/sites-enabled/

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Expose port 80
EXPOSE 80

# Create startup script
RUN echo '#!/bin/sh\n\
nginx -g "daemon off;" & \n\
php-fpm\n\
' > /usr/local/bin/start.sh && chmod +x /usr/local/bin/start.sh

# Start both nginx and php-fpm
CMD ["/usr/local/bin/start.sh"] 