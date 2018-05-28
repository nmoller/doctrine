FROM shippingdocker/php-composer:latest

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/America/Toronto /etc/localtime
RUN "date"

RUN apt-get update && apt-get install -y \
    git \
    libicu-dev \
    unzip

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install pdo pdo_mysql intl

# Install opcache
RUN docker-php-ext-install opcache
RUN echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
RUN echo "realpath_cache_size=4096K" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
RUN echo "realpath_cache_ttl=600" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini