# Laravel stripe subscriptions example

🚧 Work in progress

Demo: http://laravel-stripy.herokuapp.com/

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

## Install

```bash
$ composer install
$ cp .env.example .env
$ php artisan key:generate
```

Add your database and Stripe credentials inside the `.env` file.

```bash
$ php artisan migrate
```

```bash
$ php artisan db:seed # adds 10 fake users and 10 fake posts
```

Manually add your Stripe products in `plans` table, including Stripe Id.

## Usage

```bash
$ php artisan serve
```

## Dependencies

- [Laravel UI](https://github.com/laravel/ui) (Bootstrap 4)
- [Laravel Cashier 12](https://laravel.com/docs/8.x/billing)
