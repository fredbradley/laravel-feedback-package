# Store feedback from multiple apps into one shared database

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fredbradley/feedback.svg?style=flat-square)](https://packagist.org/packages/fredbradley/feedback)
[![Total Downloads](https://img.shields.io/packagist/dt/fredbradley/feedback.svg?style=flat-square)](https://packagist.org/packages/fredbradley/feedback)
![GitHub Actions](https://github.com/fredbradley/feedback/actions/workflows/main.yml/badge.svg)

## Installation

You can install the package via composer:

```bash
composer require fredbradley/feedback
```

You'll need to create a database and then add the connection to your app's `config/database.php` file as follows. The connection name must be **`laravel-feedback`**.
```php
/**
 * This assumes that you're putting your Feedback database into a MySQL with similar credentials 
 * to your default MySQL connection. You can use any database connection you wish. 
 */
'laravel-feedback' => [
    'driver'      => 'mysql',
    'host'        => env('DB_HOST', '127.0.0.1'),
    'port'        => env('DB_PORT', '3306'),
    'database'    => 'feedback', // can be anything you want
    'username'    => env('DB_USERNAME', 'forge'),
    'password'    => env('DB_PASSWORD', ''),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset'     => 'utf8mb4',
    'collation'   => 'utf8mb4_unicode_ci',
    'prefix'      => '',
    'strict'      => true,
    'engine'      => null,
],
```

You can then run `php artisan migrate` which will create the necesary two tables into the database using THAT connection. If you're cautious you can pass the optional `--database` argument to that laravel command as follows: 
```bash
php artisan migrate --database=laravel-feedback
```

## Usage

```php
// Log some feedback, takes an array of questions and answers, and a free LONGTEXT field.
Feedback::log(
    [
        "Did you do everything you wanted to do today?" => "Yes",
        "Would message would you like to give to the developers?" => "They're bloody brilliant!",
    ], 
    "I was also thinking it would be cool if you could flash the page pink when something fun happens, and perhaps animate some unicorns flying across the page!"
);
/**
 * When submitted the package will grab the UserAgent of the client that has submitted the feedback, 
 * along with the site url and site name (from config/app.php). It also saves the ID of the 
 * Authenticatable model of your app. So you can track specific users giving specific
 * feedback, so that you can give them a better user experience. 
 */
```
#### Return Value Example
```php
FredBradley\Feedback\Models\FeedbackRecord {#3053
     site_id: 1,
     feedback: "{"Do you enjoy chocolate?":"Yes, I bloomin love it!","Would you eat more chocolate if you could":"Absolutely"}",
     client_meta: "{"UserAgent":"Symfony","UserID":null}",
     other_comments: "Can you send more more chocolate, please?",
     updated_at: "2021-12-21 15:58:05",
     created_at: "2021-12-21 15:58:05",
     id: 1,
   }
```

```php
// Get all the feedback for your container app
Feedback::bySite();

// Get all feedback from any site by url
Feedback::bySite('https://mysite.example.com'); // This URL has to match the value of `config('app.url')` on any package that this is installed into. 
```

### Testing 😂
_Yeah, sorry - not written any tests yet!_

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email code@fredbradley.co.uk instead of using the issue tracker.

## Credits

-   [Fred Bradley](https://github.com/fredbradley)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
