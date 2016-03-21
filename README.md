[![Latest Stable Version](https://poser.pugx.org/alphazygma/combinatorics/v/stable)](https://packagist.org/packages/alphazygma/combinatorics)
[![Total Downloads](https://poser.pugx.org/alphazygma/combinatorics/downloads)](https://packagist.org/packages/alphazygma/combinatorics)
[![Latest Unstable Version](https://poser.pugx.org/alphazygma/combinatorics/v/unstable)](https://packagist.org/packages/alphazygma/combinatorics)
[![License](https://poser.pugx.org/alphazygma/combinatorics/license)](https://packagist.org/packages/alphazygma/combinatorics)

# COMBINATORICS

> [Wikipedia](https://en.wikipedia.org/wiki/Combinatorics) : **Combinatorics** is a branch of mathematics concerning the study of finite or countable discrete 
structures. Aspects of combinatorics include counting the structures of a given kind and size 
(enumerative combinatorics), deciding when certain criteria can be met, and constructing and analyzing 
objects meeting the criteria (as in combinatorial designs and matroid theory), finding "largest", 
"smallest", or "optimal" objects (extremal combinatorics and combinatorial optimization), and studying 
combinatorial structures arising in an algebraic context, or applying algebraic techniques to 
combinatorial problems (algebraic combinatorics).


## Disclosure

The _Combination_ and _Permutation_ implementation is based on the work of _David Sanders_ (<shangxiao@php.net>).

Source   | Link
-------- | ---------------------------------------------------------
PEAR     | <https://pear.php.net/package/Math_Combinatorics>
Pckagist | <https://packagist.org/packages/pear/math_combinatorics>
Github   | <https://github.com/pear/Math_Combinatorics>


### Combinations

This version is similar to David's with the difference that the base method will return all possible 
combinations based on the supplied set.

It also provides with a Static method to access the class as a utility, so if you need this functionality 
very often, use the Instance approach for you'll get better performance, but if you use it here and 
there, the static access may prove more readable.

Additionally, it detaches the Pointers functionality into it's own class, providing a bit more 
clarity into the Combinations code as well as making it better thread-safe as the pointers are no 
longer an attribute of the class shared across the methods, it is an object created for each run and 
thus allowing to run multiple combinations in parallel from the same class instance without having 
them interfere with each other.


## Changelog

 - 0.1 Port of the Combinations library - need to add unit tests, perform some more package inclusion testing
 and add the Usage section examples.



## Usage

add this section !


## Install

The easiest way to install is through [composer](http://getcomposer.org).

Just create a composer.json file for your project:

```JSON
{
    "require": {
        "alphazygma/combinatorics": ">1.0"
    }
}
```

Then you can run these two commands to install it:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar install

or simply run `composer install` if you have have already [installed the composer globally](http://getcomposer.org/doc/00-intro.md#globally).

Then you can include the autoloader, and you will have access to the library classes:

```php
<?php
require 'vendor/autoload.php';
```
