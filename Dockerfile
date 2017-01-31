FROM webdevops/php-apache-dev:debian-9

COPY ./public /app/public
COPY ./src /app/src
COPY composer.* /app/

WORKDIR /app

RUN php composer.phar install --no-progress --no-suggest

ENV WEB_DOCUMENT_ROOT=/app/public