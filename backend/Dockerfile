FROM php:8.3-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpng-dev \
    libzip-dev \
    zip \
    curl

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# App directory
WORKDIR /var/www

# Copy Laravel project
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Remove default nginx site
RUN rm -f /etc/nginx/sites-enabled/default

# Copy custom nginx config
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Expose nginx port
EXPOSE 80

# Start PHP-FPM + nginx
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"