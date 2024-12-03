# Use the official PHP-FPM image
FROM php:8.3-fpm

# Update and install required packages
RUN apt update && apt install -y \
    g++ zip git curl supervisor nginx \
    zlib1g-dev libicu-dev libzip-dev libonig-dev libpng-dev \
    && docker-php-ext-install intl opcache pdo mysqli pdo_mysql mbstring gd zip pcntl \
    && pecl install apcu \
    && docker-php-ext-enable apcu

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Copy the environment file
COPY .env /var/www/html/.env

# Install Node.js dependencies and build assets
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install \
    && npm run build

# Copy Nginx and Supervisord configuration files
COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set up file permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 8080 for the application
EXPOSE 8080

# Start Supervisor to manage Nginx and PHP-FPM
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
