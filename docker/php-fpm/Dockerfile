FROM php:5.6-fpm

RUN apt-get update && apt-get install -y libicu52 libicu-dev
RUN docker-php-ext-install intl mbstring pdo_mysql
RUN docker-php-ext-install opcache

ADD php-fpm.conf /usr/local/etc/php-fpm.conf

CMD ["php-fpm"]
