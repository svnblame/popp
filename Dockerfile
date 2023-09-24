FROM php:8.2.10-cli
RUN apt-get update && apt upgrade -y
ADD ./src /var/www/html
