#!/bin/sh

php artisan config:cache
php artisan migrate --force

exec "$@"