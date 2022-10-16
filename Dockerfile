FROM php:8.1.12RC1-apache-buster
FROM phpmyadmin:apache
FROM msql
FROM httpd

ENV MYSQL_ROOT_PASSWORD=Halsnewram!18
ENV MYSQL_USER=tibthink
ENV MYSQL_PASSWORD=Halsnewram

COPY . /var/www/php

EXPOSE 80 