FROM ubuntu

# Set environment variables
ENV DATABASE_PASSWORD=<password>

# Install Apache, PHP, and necessary extensions
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y apache2 php7.4 libapache2-mod-php7.4 php7.4-mysql php7.4-curl php7.4-gd php7.4-json php7.4-mbstring php7.4-intl php7.4-xml php7.4-zip

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
COPY ./config/php.ini /etc/php/7.4/apache2/php.ini

# Copy SSL certificates
COPY ./config/ssl.crt /etc/ssl/certs/ssl.crt
COPY ./config/ssl.key /etc/ssl/private/ssl.key

# Expose HTTP and HTTPS ports
EXPOSE 80
EXPOSE 443

# Start Apache
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
