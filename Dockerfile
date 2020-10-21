FROM php:7.4-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev git zip
RUN docker-php-ext-install exif
RUN docker-php-ext-install opcache

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql


WORKDIR /app

COPY ./ /app

CMD ["php-fpm", "--nodaemonize"]

EXPOSE 9000