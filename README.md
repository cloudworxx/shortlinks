# Generate shortlinks for your Laravel routes or arbitrary URLs.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/shortlinks.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/shortlinks)
[![Quality Score](https://img.shields.io/scrutinizer/g/ryangjchandler/shortlinks.svg?style=flat-square)](https://scrutinizer-ci.com/g/ryangjchandler/shortlinks)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/shortlinks.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/shortlinks)

This package can be used to generate short links for your Laravel routes or arbitrary URLs. It's best used when sharing links from your site, such as blog posts or promotion links.

This package also provides some very basic tracking, including click, IP and user agent tracking. 

## Installation

You can install the package via composer:

```bash
composer require ryangjchandler/shortlinks
```

## Usage

If you wish to modify the configuration file, you need to publish the service provider:

```bash
php artisan vendor:publish --provider="RyanChandler\Shortlinks\ShortlinksServiceProvider" --tag=config
```

### Generating shortlinks

There are two ways to generate a shortlink, using either a route or arbitrary URL.

### Route

```php
use RyanChandler\Shortlinks\Facades\Shortlinks;

Shortlinks::route('route', ['params' => true])->generate();
```

This method has the same signature as Laravel's `route()` helper function.

### URL

```php
use RyanChandler\Shortlinks\Facades\Shortlinks;

Shortlinks::url('https://github.com')->generate();
```

### Configuring tracking

Inside of the configuration file, you'll find a `tracking` key. Use this to modify which information gets tracked.

To track all information, including clicks, IP and user agent, you can set the `tracking` to `true`:

```php
<?php

return [

    ...

    'tracking' => true,

];
```

You can also individually enable each tracking feature.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ryan@chandler.codes instead of using the issue tracker.

## Credits

- [Ryan Chandler](https://github.com/ryangjchadler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
