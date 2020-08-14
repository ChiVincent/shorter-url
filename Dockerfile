FROM composer:2 AS php_builder

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
    # Setup Nginx
    cp .docker/conf/nginx/nginx.conf /etc/nginx/nginx.conf && \
    cp .docker/conf/nginx/www.conf /etc/nginx/conf.d/www.conf && \
    # Setup PHP
    cp .docker/conf/php/php.ini /usr/local/etc/php/php.ini && \
    cp .docker/conf/php/fpm.conf /usr/local/etc/php-fpm.d/www.conf && \
    rm /usr/local/etc/php-fpm.d/zz-docker.conf && \
    # Setup suervisor
    mkdir -p /var/log/supervisor && \
    cp .docker/conf/supervisor/supervisord.conf /etc/supervisor/supervisord.conf && \
    cp .docker/conf/supervisor/nginx.conf /etc/supervisor/conf.d/nginx.conf && \
    cp .docker/conf/supervisor/php-fpm.conf /etc/supervisor/conf.d/php-fpm.conf && \
    # Setup laravel
    touch database/database.sqlite && \
    chmod -R 777 bootstrap/cache storage database && \
    php artisan route:cache && php artisan view:cache

ENTRYPOINT [ ".docker/entrypoint.sh" ]

CMD ["/usr/bin/supervisord"]