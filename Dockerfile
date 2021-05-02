FROM ceetny/alpine-php-server:alpine_3_8_php_7_3
MAINTAINER Alexander Garuba <alexandergaruba96@gmail.com>

RUN apk update && apk add --no-cache supervisor

COPY supervisord.conf /etc/supervisord.conf
