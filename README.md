## Attributable

[![Build Status](https://travis-ci.org/rkgrep/attributable.svg)](https://travis-ci.org/rkgrep/attributable)
[![Latest Stable Version](https://poser.pugx.org/rkgrep/attributable/v/stable.svg)](https://packagist.org/packages/rkgrep/attributable)
[![Latest Unstable Version](https://poser.pugx.org/rkgrep/attributable/v/unstable.svg)](https://packagist.org/packages/rkgrep/attributable)
[![License](https://poser.pugx.org/rkgrep/attributable/license.svg)](https://packagist.org/packages/rkgrep/attributable)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e45ce10a-4c45-48e4-851a-9d95436f6e58/mini.png)](https://insight.sensiolabs.com/projects/e45ce10a-4c45-48e4-851a-9d95436f6e58)

> **Note:** Original idea by Taylor Otwell in [Laravel Framework](https://github.com/laravel/framework).

The package includes traits which allow fluent and elegant way to work with internal object property arrays.

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

````php
class Bar {
    
    use rkgrep\Fillable;
    
}
````

## Usage

### Attributable trait

`Attributable` provides different access and assignment ways.

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

### Fillable trait

`Fillable` provides chaining assignment of variables or groups of variables.

Mass assign atributes with `fill` method

````php
$user->fill(['name' => 'Admin', 'email' => 'admin@example.com']);
````

Overwrite or reassign control via second parameter

````php
$user->fill(['name' => 'John Doe']); // Name changed, email remains untouched
$user->fill(['email' => 'other@example.com'], false); // Disabled merging - old values are dropped
````

Fill specific properties with `with` method

````php
$user->with('password', md5('password'));
````

Prevent overriding with third parameter

````php
$user->with('password', '', false); // Password remains untouched
````

Assign multiple variables

````php
$user->with(['friends' => ['Mike', 'Dave'], 'girlfriend' => 'Jane']);
$user->with(['siblings' => [], 'girlfriend' => 'Mary'], null, false); // Overriding disabled - only siblings are touched
````

Chain method calls

````php
$post->fill(['title' => 'Lorem Ipsum'])->with('views', 5)->with('likes', 3);
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
