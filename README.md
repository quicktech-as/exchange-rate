# Quicktech\ExchangeRate (Laravel 5 Package)

Quicktech\ExchangeRate is a succinct and flexible way to use [ExchangeRate API](https://www.exchangerate-api.com) to convert currencies in **Laravel 5** applications.

## Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
    - [Get rates based on default currency](#get-rates-based-on-default-currency)
    - [Convert currency value](#convert-currency-value)
- [License](#license)
- [Contribution guidelines](#contribution-guidelines)
- [Additional information](#additional-information)

## Installation

1) In order to install Laravel 5, just add the following to your composer.json. Then run `composer update`:

```json
"quicktech-as/exchange-rate": "^1.0"
```

2) Open your `config/app.php` and add the following to the `providers` array:

```php
Quicktech\ExchangeRate\ExchangeRateServiceProvider::class,
```

3) In the same `config/app.php` and add the following to the `aliases ` array: 

```php
'ExchangeRate' => Quicktech\ExchangeRate\Facade\ExchangeRate::class,
```

4) Run the command below to publish the package config file `config/exchange_rate.php`:

```shell
php artisan vendor:publish
```

## Configuration

Open your `.env` file and setup your ExchangeRate credentials:

```php
EXCHANGERATE_DEFAULT_CURRENCY = 'your default currency'
EXCHANGERATE_API_KEY = 'your api key'
EXCHANGERATE_API_URI = 'https://v3.exchangerate-api.com'
```

## Usage

### Get rates based on default currency
To get all rates based on your defult currency, you can use this resource:

```php
$rates = ExchangeRate::rates();
```

The method above will return the following response:

```php
[
    "AUD" => 1.32230,
    "BGN" => 1.8096,
    "BRL" => 3.11,
    "..." => 1.31135,
    "..." => 7.473, etc. etc.
]
```
### Convert currency value
To convert currency value, you can use this resource:

```php
$value = ExchangeRate::convert(10.00, 'USD', 'BRL');
// 31.11
```

## License

Quicktech\ExchangeRate is free software distributed under the terms of the MIT license.

## Contribution guidelines

Please report any issue you find in the issues page.  
Pull requests are welcome.
