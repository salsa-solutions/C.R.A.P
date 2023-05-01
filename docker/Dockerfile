FROM ubuntu:latest

# Install Apache, PHP, and PHP extensions
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y apache2 libapache2-mod-php php-mysql php-pgsql php-mbstring && \
    a2enmod rewrite

# Install MySQL client and PHPMyAdmin
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y default-mysql-client phpmyadmin && \
    echo "Include /etc/phpmyadmin/apache.conf" >> /etc/apache2/apache2.conf

# Copy files from local machine to web server default folder
COPY ../ /var/www/html/

# Set working directory to web server default folder
WORKDIR /var/www/html/

# Expose ports for Apache and MySQL
EXPOSE 80 3306

# Start Apache and MySQL services
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
