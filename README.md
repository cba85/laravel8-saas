# Laravel SaaS

> For demonstration purpose only

Demo: http://laravel-stripy.herokuapp.com/

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

## Requirements

- [Stripe](https://stripe.com/fr) account
- [Cloudinary](https://cloudinary.com/) account

## Install

### 1. Install

```bash
$ composer install
$ cp .env.example .env
$ php artisan key:generate
```

### 2. Update your credentials

Add your database, Stripe and Cloudinary credentials into the `.env` file.

### 3. Migrate your database

```bash
$ php artisan migrate
```

OPTIONAL: adds 10 fake users and 10 fake posts

```bash
$ php artisan db:seed
```

### 4. Store your Stripe products in your database

Manually add your Stripe products in `plans` table, including Stripe Id.

### 5. File storage

OPTIONAL: If you prefer to use Laravel public disk storage instead Cloudinary:

```bash
$ php artisan storage:link
```

## Usage

```bash
$ php artisan serve
```

## Dependencies

- [Laravel 8](https://laravel.com/)
- [Laravel UI](https://github.com/laravel/ui) (Bootstrap 4)
- [Laravel Cashier 12](https://laravel.com/docs/8.x/billing)
- [Laravel Cloudinary](https://github.com/cloudinary-labs/cloudinary-laravel)
