FROM php:8.0-fpm

ARG XDEBUG_HOST
ARG ENV

# Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
# && install-php-extensions intl

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev


RUN if [ "$ENV" != "production" ]; then pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_host=${XDEBUG_HOST}" >> /usr/local/etc/php/conf.d/xdebug.ini; fi


# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY docker/php/custom.ini /usr/local/etc/php/conf.d
CMD ["php-fpm"]
