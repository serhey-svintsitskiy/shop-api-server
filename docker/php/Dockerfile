FROM php:8.2-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends -f git iproute2 imagemagick libmagickwand-dev libicu-dev \
    libzip-dev zip libpng-dev libmemcached-dev psmisc librabbitmq-dev openssh-server apache2 supervisor \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/run/sshd /var/log/supervisor

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN pecl install memcached xdebug
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl zip pdo pdo_mysql gd zip bcmath sockets exif
RUN docker-php-ext-enable xdebug pdo_mysql

RUN apt-get update && \
    apt-get install -y libxslt1-dev && \
    docker-php-ext-install xsl && \
    apt-get remove -y libxslt1-dev icu-devtools libicu-dev libxml2-dev && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-source extract \
    && git clone --branch latest --depth 1 https://github.com/php-amqp/php-amqp.git /usr/src/php/ext/amqp \
    && cd /usr/src/php/ext/amqp && git submodule update --init \
    && docker-php-ext-install amqp

COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY supervisord.conf /etc/supervisor/
COPY supervisor/* /etc/supervisor/conf.d

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]

RUN usermod -o -u 1000 -g www-data www-data \
    && groupmod -o -g 1000 www-data \
    && chmod 777 /var/www;

WORKDIR /opt/project
