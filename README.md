# FileFetcher Stopwatch

[![Build Status](https://travis-ci.org/JeroenDeDauw/file-fetcher-stopwatch.svg?branch=master)](https://travis-ci.org/JeroenDeDauw/file-fetcher-stopwatch)

Provides a [FileFetcher](https://github.com/JeroenDeDauw/FileFetcher) [decorator](https://en.wikipedia.org/wiki/Decorator_pattern)
that profiles file fetching using [Symfony Stopwatch](https://symfony.com/doc/current/components/stopwatch.html).

## Usage

The FileFetcher decorators is constructed via [`FileFetcher\Stopwatch\Factory`](src/Factory.php).

```php
$fileFetcher = (new Factory())->newStopwatchFetcher($innerFetcher, $stopwatch);
```

Once you constructed a FileFetcher, fetching a file is easy:

```php
$fileContent = $fileFetcher->fetchFile($fileLocation);
```

To test your code you can use all the test doubles provided by [FileFetcher](https://github.com/JeroenDeDauw/FileFetcher) itself.

## Installation

To use the FileFetcher Stopwatch library in your project, simply add a dependency on jeroen/file-fetcher-stopwatch
to your project's `composer.json` file. Here is a minimal example of a `composer.json`
file that just defines a dependency on FileFetcher Stopwatch 1.x:

```json
{
    "require": {
        "jeroen/file-fetcher-stopwatch": "~1.0"
    }
}
```

## Development

Start by installing the project dependencies by executing

    composer update

You can run the tests by executing

    make test
    
You can run the style checks by executing

    make cs
    
To run all CI checks, execute

    make ci
    
You can also invoke PHPUnit directly to pass it arguments, as follows

    vendor/bin/phpunit --filter SomeClassNameOrFilter

## Release notes

### 1.0.0 (2019-01-17)

* Initial version with 