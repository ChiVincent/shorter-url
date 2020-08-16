# Shorter URL

- Testing: [![Actions Status](https://github.com/ChiVincent/shorter-url/workflows/Laravel/badge.svg)](https://github.com/ChiVincent/shorter-url/workflows/Laravel/badge.svg)
- Building: [![Actions Status](https://github.com/ChiVincent/shorter-url/workflows/Build/badge.svg)](https://github.com/ChiVincent/shorter-url/workflows/Build/badge.svg)

The Shorten URL service, made with [Laravel](https://laravel.com) and [React](https://reactjs.org).

## Requirements

- Laravel Runtime
- Docker Runtime

## Installation

```
git clone git@github.com:ChiVincent/shorter-url.git
```

### Local Development: For Developers

```
composer install

touch database/database.sqlite

php artisan migrate
php artisan key:generate
php artisan test
```

### Production

We use docker-compose to manage the dependencies.

```
cp .env.example .env

echo '' > database/database.sqlite
docker-compose up
```

> Note: It's **VERY IMPORTANT** to change `HASH_ID_SALT` in `.env` before `docker-compose up`.

#### Loadbalancer Setting

The service will use `localhost:8080` by default, add a loadbalancer (e.g. Nginx, HA-Proxy, Traffik) to manage SSL setting or domain name.

#### Logging

The logged file will be stored at:

- Nginx: `storage/logs/nginx`
- Laravel： `storage/logs/laravel.log`

## LICENSE

This web application is under [MIT](https://opensource.org/licenses/MIT) license.
