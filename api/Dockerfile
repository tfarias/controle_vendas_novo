FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www

RUN apt-get update && \
    apt-get install libzip-dev -y && \
    docker-php-ext-install zip && \
    docker-php-ext-install pdo pdo_mysql bcmath

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www
RUN chown -R www-data:www-data /var/www
RUN chmod 777 $(pwd)
RUN composer install
RUN chmod -R 777 storage
RUN chmod -R 775 storage
RUN chmod -R 775 bootstrap
RUN php artisan config:cache
RUN php artisan config:clear
# Expose port 9000 and start php-fpm server
EXPOSE 9000
