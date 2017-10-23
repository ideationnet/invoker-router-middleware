# Stack Runner

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A simple PSR-15 compatible invoker router middleware. 

From an array of routes this will dispatch and invoke anything 
supported by your InvokerInterface implementation.
Based on [FastRoute](https://github.com/nikic/FastRoute).
Useful in Action Domain Responder (ADR) architectures when 
used with the invokable Action class.


## Requirements

 * PHP7+
 * Any [PSR-15](https://github.com/http-interop/http-middleware) compatible middleware runner
 * An invoker compatible with [InvokerInterface](https://github.com/PHP-DI/Invoker/blob/master/src/InvokerInterface.php)

## Install

Via Composer

```bash
$ composer require ideationnet/invoker-router-middleware
```

## Usage

TBC...



## Security

If you discover any security related issues, please email
darren@darrenmothersele.com instead of using the issue tracker.


## Credits

- [Darren Mothersele](http://www.darrenmothersele.com)
- [All Contributors](../../contributors)

## License

The MIT License. Please see [License File](License.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/ideationnet/invoker-router-middleware.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/ideationnet/invoker-router-middleware/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/ideationnet/invoker-router-middleware.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/ideationnet/invoker-router-middleware.svg?style=flat-square
[ico-packagist]: https://img.shields.io/packagist/v/ideationnet/invoker-router-middleware.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ideationnet/invoker-router-middleware.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ideationnet/invoker-router-middleware
[link-travis]: https://travis-ci.org/ideationnet/invoker-router-middleware
[link-scrutinizer]: https://scrutinizer-ci.com/g/ideationnet/invoker-router-middleware/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/ideationnet/invoker-router-middleware
[link-downloads]: https://packagist.org/packages/ideationnet/invoker-router-middleware
[link-author]: https://github.com/darrenmothersele
[link-contributors]: ../../contributors
