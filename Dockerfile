FROM php:7.4-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev git zip
RUN docker-php-ext-install exif
RUN docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql


WORKDIR /app

COPY ./ /app


RUN composer install --prefer-dist --no-progress --no-suggest --no-interaction

CMD ["php-fpm", "--nodaemonize"]

EXPOSE 9000