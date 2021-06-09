FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www

RUN apt-get update --fix-missing
RUN apt-get install -y curl
RUN apt-get install -y build-essential libssl-dev libzip-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql bcmath
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www
RUN chown -R www-data:www-data /var/www
RUN chmod 777 $(pwd)
RUN composer install
RUN chmod -R 777 storage
RUN chmod -R 777 bootstrap
RUN php artisan config:cache
RUN php artisan config:clear
# Expose port 9000 and start php-fpm server
EXPOSE 9000
