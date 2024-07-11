FROM drupal:10

# Install required tools
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    default-mysql-client \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Install Drush globally using Composer
RUN composer global require drush/drush

# Install Drupal core and dependencies
RUN composer global require drupal/core

# Create a symbolic link to make Drush globally accessible
RUN ln -s /var/www/html/vendor/bin/drush /usr/local/bin/drush

# Set the working directory
WORKDIR /var/www/html

# Make sure permissions are set correctly
RUN chown -R www-data:www-data /var/www/html

# Copy the rest of your Drupal site
COPY . /var/www/html

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html/web/modules/custom

# Copy the created module to docker container
COPY ./web/modules/custom/events_management /var/www/html/web/modules/custom/events_management