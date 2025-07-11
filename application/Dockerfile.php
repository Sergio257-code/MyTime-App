# Use PHP 7.4 base image with FPM
FROM php:7.4-fpm

# Set working directory inside the container
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy the existing Laravel project files to the container
COPY . .

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions (adjust to match your app needs)
RUN chown -R www-data:www-data /var/www

# Expose port (default for Laravel's built-in server)
EXPOSE 8000

# Start Laravel using Artisan
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
