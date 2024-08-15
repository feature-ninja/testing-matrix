# Testing Matrix

[![Latest Version on Packagist](https://img.shields.io/packagist/v/feature-ninja/testing-matrix.svg?style=flat-square)](https://packagist.org/packages/feature-ninja/testing-matrix)
[![Tests](https://img.shields.io/github/actions/workflow/status/feature-ninja/testing-matrix/run-phpunit.yml?branch=main&label=tests&style=flat-square)](https://github.com/feature-ninja/testing-matrix/actions/workflows/run-phpunit.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/feature-ninja/testing-matrix.svg?style=flat-square)](https://packagist.org/packages/feature-ninja/testing-matrix)

Easily test multiple scenarios by creating a testing matrix

## Installation

You can install the package via composer:

```bash
composer require feature-ninja/testing-matrix
```

## Usage

Create a testing matrix from an array:

```php
use FeatureNinja\TestingMatrix\Matrix;

$matrix = Matrix::create([
    'a' => [1, 2],
    'b' => [3, 4],
]);

assert(iterator_to_array($matrix) === [
    'a=1 b=3' => [1, 3],
    'a=1 b=4' => [1, 4],
    'a=2 b=3' => [2, 3],
    'a=2 b=4' => [2, 4],
]);
```

Usage in PHPUnit:

```php
use FeatureNinja\TestingMatrix\Matrix;
use PHPUnit\Framework\Attributes\DataProvider;use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public static function example_data_provider(): Generator
    {
        yield from Matrix::create([
            'a' => [1, 2],
            'b' => [3, 4],
        ]);
    }
    
    #[Test]
    #[DataProvider('examples')]
    public function example(int $a, int $b): void
    {
        // ...
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Roj Vroemen](https://github.com/rojtjo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
