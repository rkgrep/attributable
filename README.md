## Attributable trait

[![Build Status](https://travis-ci.org/rkgrep/attributable.svg)](https://travis-ci.org/rkgrep/attributable)

> **Note:** Original idea by Taylor Otwell in [Laravel Framework](https://github.com/laravel/framework).

The trait is used to provide fast and elegant way to work with objects.

## Installation

Install the package with composer.
````
composer require rkgrep/attributable
````

Apply the trait to any class you need.

````php
class Foo {
    
    use rkgrep\Attributable;
    
}
````

## Usage

Assign internal variables via property or method call

````php
$foo->var1 = 1;
$foo->var2(2);
````

Access variables via property

````php
echo $foo->var1;
echo $foo->var2;
````

Provide fallback value via `get` method

````php
$foo->get('var4', 'fallback');
$foo->get('var5', function() { return 'closure result'; });
````

Get all internal variables via `getAttributes` method

````php
$all = $foo->getAttributes();
````

Method call without arguments assigns `true`

````php
$foo->viewable();
true == $foo->viewable;
````

Chain methods for fast assignment

````php
$user->first_name('John')->last_name('Doe')->admin();
````

## Interfaces

Any class with `Attributable` trait applied implements `ArrayAccess` and `JsonSerializable`.
If you use *illuminate/support* package you can also apply `Arrayable` and `Jsonable` interfaces.

````php
class Bar implements ArrayAccess, JsonSerializable, Arrayable, Jsonable {
    use rkgrep\Attributable;
}

$bar = new Bar();
$bar->value('test');

$arrayValue = $bar['value'];
$bar['value'] = 'new';
$json = json_encode($bar); // returns '{"value": "new"}'

$array = $bar->toArray();
$json = $bar->toJson();
````

## License

**Attributable** package is open-sourced package licensed under the [MIT license](http://opensource.org/licenses/MIT).
