FROM composer AS php_builder

WORKDIR /code

COPY . .

RUN composer install --no-dev --prefer-dist --optimize-autoloader --classmap-authoritative

FROM node:alpine AS node_builder

WORKDIR /code

COPY . .

RUN npm install && npm run production

FROM php:fpm

WORKDIR /www

COPY --from=php_builder /code .
COPY --from=node_builder /code/public ./public

# Install supervisor and nginx
RUN apt-get update -yq && apt-get install -y nginx supervisor && \
# Install PHP Extensions
    docker-php-ext-install bcmath opcache && \
# Setup Nginx, PHP-FPM and supervisor
    # Make supervisor log directory
    mkdir -p /var/log/supervisor && \
    # Setup suervisor
    cp .docker/conf/supervisor/nginx.conf /etc/supervisor/conf.d/nginx.conf && \
    cp .docker/conf/supervisor/php-fpm.conf /etc/supervisor/conf.d/php-fpm.conf

CMD ["/usr/bin/supervisord"]