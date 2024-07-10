FROM drupal:10

# Set environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    PATH="/root/.composer/vendor/bin:$PATH"

# Install required tools
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Install Drush globally using Composer
RUN composer global require drush/drush

# Copy the rest of your Drupal site
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Make sure permissions are set correctly
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start the server
CMD ["apache2-foreground"]