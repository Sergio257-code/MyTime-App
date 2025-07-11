# Utilise une image officielle PHP avec extensions nécessaires
FROM php:8.2-fpm

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    npm

# Installe les extensions PHP requises
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définit le dossier de travail
WORKDIR /var/www

# Copie le code source
COPY . /var/www

# Installe les dépendances PHP et JS
RUN composer install
RUN npm install && npm run build

# Donne les bons droits
RUN chown -R www-data:www-data /var/www

# Expose le port 8000
EXPOSE 8000

# Commande de démarrage
CMD php artisan serve --host=0.0.0.0 --port=8000