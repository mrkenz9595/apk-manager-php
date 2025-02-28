FROM php:7.4-apache

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

COPY php.ini /etc/php/7.4/apache2/php.ini

RUN apt-get update && apt-get install -y aapt && apt-get upgrade -y
