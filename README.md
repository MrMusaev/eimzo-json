# E-Imzo JSON Integration 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mrmusaev/eimzo-json.svg?style=flat-square)](https://packagist.org/packages/mrmusaev/eimzo-json)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mrmusaev/eimzo-json/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mrmusaev/eimzo-json/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mrmusaev/eimzo-json.svg?style=flat-square)](https://packagist.org/packages/mrmusaev/eimzo-json)
<!-- [![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mrmusaev/eimzo-json/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mrmusaev/eimzo-json/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain) --> 

The package is for integration with a new version of E-Imzo Uzbekistan, with REST-API implementation. 

## Installation

You can install the package via composer:

```bash
composer require mrmusaev/eimzo-json
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="eimzo-json-config"
```

## Usage

```php
$eImzo = new MrMusaev\EImzo();
echo $eImzo->echoPhrase('Hello, MrMusaev!');
```

## Testing

Run the tests with: 
```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [MrMusaev](https://github.com/MrMusaev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
