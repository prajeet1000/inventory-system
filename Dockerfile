#Dockerfile

# Use an official PHP runtime as a parent image
FROM php:7.4-apache
# Update and install required packages
RUN apt-get update -y && apt-get install -y git default-mysql-client
# Enable the mysqli extension
RUN docker-php-ext-install mysqli
# Clone your PHP application into the container
RUN git clone https://github.com/prajeet1000/inventory-system.git /var/www/html/
# Expose the port the web server will run on
EXPOSE 80
# Start the Apache web server
CMD ["apache2-foreground"]
