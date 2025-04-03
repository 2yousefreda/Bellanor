
# Velanor API Documentation

## Introduction

Velanor API is a project aimed at providing a robust and flexible API for use in web and mobile applications. The project aims to provide a set of services that can be used to create powerful and flexible applications.

## Features

* Robust and flexible API that can be used in web and mobile applications
* Set of services that can be used to create powerful and flexible applications
* Full support for PHP language
* Use of Laravel framework to create the project
* Full support for MySQL database usage
* Set of security features to ensure data security
* Ability to receive notifications via email

## Idea

The idea behind the project is to provide a robust and flexible API that can be used in web and mobile applications. The project aims to provide a set of services that can be used to create powerful and flexible applications.

## Project Structure

The project consists of a set of files and folders created using the Laravel framework. The project contains a set of files that represent the API, as well as a set of files that represent the services provided by the API.

## Files and Folders

* `app/Http/Resources`: contains a set of files that represent the API
* `app/Http/Controllers`: contains a set of files that represent the services provided by the API
* `config`: contains a set of files that represent the general settings of the project
* `public`: contains a set of files that represent the public interface of the project
* `resources/views`: contains a set of files that represent the graphical interface of the project
* `routes`: contains a set of files that represent the routes of the project

## Database

The project uses MySQL as the database management system. The database is used to store and manage data for the API.

## Database Configuration

To configure the database, you need to update the `config/database.php` file with your MySQL database credentials.

```php
'mysql' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'velanor_api'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => false,
    'engine' => null,
],
```

## Email Notifications

The project uses the Laravel Mail system to send email notifications. To configure email notifications, you need to update the `config/mail.php` file with your email settings.

```php
'mail' => [
    'driver' => env('MAIL_MAILER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 587),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Velanor API'),
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
],
```

## Installation

The project can be installed using the following command:

```bash
composer install
```

## Running the Project

The project can be run using the following command:

```bash
php artisan serve
```

## Contributing

Contributions to the project can be made by creating a pull request on GitHub.

## License

The project is licensed under the MIT license.

## Acknowledgments

We thank all contributors to the project for their valuable contributions.

Please note that you need to configure the email settings in the `config/mail.php` file to receive email notifications.
