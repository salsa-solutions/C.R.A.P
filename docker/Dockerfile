FROM ubuntu:20.04

# Set environment variables

# Install Apache, PHP, and necessary extensions
RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    libapache2-mod-php \
    php-mysql \
    php-curl \
    php-gd \
    php-json \
    php-mbstring \
    php-intl \
    php-xml \
    php-zip

# Enable necessary Apache modules
RUN a2enmod rewrite && \
    a2enmod ssl && \
    service apache2 restart

# Install MariaDB client and necessary tools
RUN apt-get install -y mariadb-client

# Install Git
RUN apt-get install -y git

# Clone source code from Git repository
RUN git clone http://pioxy.net:Salsa/C.R.A.P.git /var/www/html

# Copy Apache site configuration
COPY ./config/apache2.conf /etc/apache2/sites-available/000-default.conf

# Copy PHP configuration
COPY ./config/php.ini /etc/php//apache2/php.ini

# Copy SSL certificates
COPY ./config/ssl.crt /etc/ssl/certs/ssl.crt
COPY ./config/ssl.key /etc/ssl/private/ssl.key

# Expose HTTP and HTTPS ports
EXPOSE 80
EXPOSE 443

# Start Apache
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
