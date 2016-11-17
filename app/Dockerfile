FROM php:7-fpm-alpine

COPY composer.phar /opt/composer.phar

COPY app.php /var/www/
COPY src/ /var/www/src
COPY composer.json /var/www/

WORKDIR /var/www
# RUN php /opt/composer.phar install