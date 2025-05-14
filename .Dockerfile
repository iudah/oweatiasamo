FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
  libzip-dev \
  && docker-php-ext-install zip pdo_mysql \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY src/ /var/www/html

RUN chown -R www-data:www-data /var/www/html 

EXPOSE 9000

CMD ["php-fpm"]