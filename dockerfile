# Dockerfile - simple PHP + Apache image
FROM php:8.1-apache

# Set working dir
WORKDIR /var/www/html

# Copy project files into container
COPY . /var/www/html

# Ensure www-data owns files
RUN chown -R www-data:www-data /var/www/html

# Install common PHP extensions for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose port 80 (apache inside container)
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
