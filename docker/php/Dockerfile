FROM php:8.2-fpm-bookworm

RUN apt-get update \
    && apt-get install -y libzip-dev libpq-dev --no-install-recommends;

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pgsql pdo_pgsql zip;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get install -y nodejs npm;

RUN useradd docker \
    && install -d -m 0755 -o docker -g docker /home/docker;

# Instalacja Xdebug
RUN pecl install xdebug \
    && mkdir -p /home/docker/xdebug \
    && chown docker:docker /home/docker/xdebug
COPY config/xdebug.ini /usr/local/etc/php/mods-available/xdebug.ini
COPY bin/ /usr/local/bin/

WORKDIR /var/www
