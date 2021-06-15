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

Manually add your Stripe products in `plans` table, including Stripe Id.

## Usage

```bash
$ php artisan serve
```
