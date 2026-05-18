FROM php:8.2-apache

# Copy source code to the apache web root
COPY . /var/www/html/

# Enable apache mod_rewrite if needed (optional for this project but good practice)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 80
