<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## HipsterGram

An InstaGram clone built using Laravel.

To run, make sure you have node and npm installed

```
node -v
npm -v
```

Clone the git repo, then run

```
composer install
php artisan migrate:refresh --seed
```

Run the site with a local development server, e.g. laravel valet.


Optional: run tests

```
phpunit
php artisan dusk
```

If you run dusk tests be sure to run 'php artisan migrate:refresh --seed' after to prevent SQL errors.

