FROM php:8.0-apache

RUN mkdir -p /var/www/html  
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y libxml2-dev libcurl4-openssl-dev unzip \
&& docker-php-ext-install mysqli pdo pdo_mysql soap curl \
&& docker-php-ext-enable soap
RUN a2enmod rewrite && a2enmod actions

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#Add user for laravel application
RUN groupadd -g 1000 noroot
RUN useradd -u 1000 -ms /bin/bash -g noroot noroot
#Copy existing application directory contents and shell scripts
COPY . .
#Se instalan los proyectos con composer
# Copy existing application directory permissions
COPY --chown=noroot:noroot . .
# Change current user to www
USER noroot
# Expose port 9000 and start php-fpm server
EXPOSE 80
CMD ["apache2-foreground"]