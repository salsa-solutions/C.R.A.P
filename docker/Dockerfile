FROM debian:bullseye

# Set command line arguments
ARG TIMEZONE=UTC
ARG WEB_SERVER=apache
ARG SQL_USERNAME=root
ARG SQL_PASSWORD=

# Set environment variables for Git
ENV GIT_USERNAME=your_git_username
ENV GIT_TOKEN=your_git_token

# Install required packages
RUN apt-get update && \
    apt-get install -y \
    uuid-dev \
    git \
    php-uuid \
    libapache2-mod-php \
    php-opcache \
    php-cli \
    php-gd \
    php-curl \
    php-mysql \
    tzdata \
    mariadb-server \
    mariadb-client && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Set timezone
RUN ln -fs "/usr/share/zoneinfo/$TIMEZONE" /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

# Clone Git repository using token
RUN mkdir /app && \
    cd /app && \
    git clone https://$GIT_USERNAME:$GIT_TOKEN@pioxy.net/salsa/C.R.A.P && \
    cd your-repo

# Configure MariaDB
RUN sed -i "s/^bind-address/#bind-address/" /etc/mysql/mariadb.conf.d/50-server.cnf && \
    service mysql start && \
    mysql -e "CREATE USER '$SQL_USERNAME'@'localhost' IDENTIFIED BY '$SQL_PASSWORD';" && \
    mysql -e "GRANT ALL PRIVILEGES ON *.* TO '$SQL_USERNAME'@'localhost';" && \
    mysql -e "FLUSH PRIVILEGES;"

# Set environment variables for web server and SQL
RUN echo "export WEB_SERVER=$WEB_SERVER" >> /etc/profile.d/web_server.sh && \
    echo "export SQL_USERNAME=$SQL_USERNAME" >> /etc/profile.d/sql.sh && \
    echo "export SQL_PASSWORD=$SQL_PASSWORD" >> /etc/profile.d/sql.sh


# Expose port 80
EXPOSE 80

# Set working directory and entry point
WORKDIR /app/your-repo
ENTRYPOINT ["/bin/bash"]
