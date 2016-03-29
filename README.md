[![Latest Stable Version](https://poser.pugx.org/alphazygma/combinatorics/v/stable)](https://packagist.org/packages/alphazygma/combinatorics)
[![Build Status](https://travis-ci.org/alphazygma/Combinatorics.svg?branch=master)](https://travis-ci.org/alphazygma/Combinatorics)
[![Coverage Status](https://coveralls.io/repos/github/alphazygma/Combinatorics/badge.svg?branch=master)](https://coveralls.io/github/alphazygma/Combinatorics?branch=master)
[![Total Downloads](https://poser.pugx.org/alphazygma/combinatorics/downloads)](https://packagist.org/packages/alphazygma/combinatorics)
[![Latest Unstable Version](https://poser.pugx.org/alphazygma/combinatorics/v/unstable)](https://packagist.org/packages/alphazygma/combinatorics)
[![License](https://poser.pugx.org/alphazygma/combinatorics/license)](https://packagist.org/packages/alphazygma/combinatorics)



# COMBINATORICS

> [Wikipedia](https://en.wikipedia.org/wiki/Combinatorics) : **Combinatorics** is a branch of mathematics 
concerning the study of finite or countable discrete structures. Aspects of combinatorics include 
counting the structures of a given kind and size (enumerative combinatorics), deciding when certain 
criteria can be met, and constructing and analyzing objects meeting the criteria (as in combinatorial 
designs and matroid theory), finding "largest", "smallest", or "optimal" objects (extremal 
combinatorics and combinatorial optimization), and studying combinatorial structures arising in an 
algebraic context, or applying algebraic techniques to combinatorial problems (algebraic combinatorics).


## Requirements

PHP 5.4+ is required. (_The `[]` short array syntax was introduced on [5.4](http://php.net/manual/en/migration54.new-features.php>)_)


## Disclosure

The _Combination_ and _Permutation_ implementation is based on the work of _David Sanders_ (<shangxiao@php.net>).

Source   | Link
-------- | ---------------------------------------------------------
PEAR     | <https://pear.php.net/package/Math_Combinatorics>
Pckagist | <https://packagist.org/packages/pear/math_combinatorics>
Github   | <https://github.com/pear/Math_Combinatorics>


## Changelog
 - 1.0 Added Permutations code (with unit tests)
 - 0.2 Unit Tests added to Combinations library.
 - 0.1 Port of the Combinations library (manual tests done, but unit tests, need to be added).



## Classes

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

**Note**: As with David's implementation, the returned combinations preserve the keys supplied. (However 
fixes a minor bug where the single element combinations would not preserve its keys)


### Permutations

As in Combinations, this code is similar to David's with the difference that both pieces are not mixed 
in the same class, Permutations is a class of its own and has an internal reference to the Combinations class.

It as well, provides with a Static method to access the class as a utility.


## Usage

_This usage considers that you have an autoloader running_. (see [Install](#Install) for more reference)

The result of the functionality is an `Array of Arrays` in which the Outer Array is a list of combinations and each Inner Array is the combination itself.

##### Retrieving all combinations for a source data set.

```php
$sourceDataSet = ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10];

// Retrieve all combinations as Utility
$combinationsList = \Math\Combinatorics\Combination::get($sourceDataSet);

// Retrieve all combinations as instance class
$combination      = new \Math\Combinatorics\Combination();
$combinationsList = $combination->getCombinations($sourceDataSet);
```

Here is a detailed version of the expanded array

```
size 1:  [`a` => 5]  [`b` => 6]  [`c` => 8]  [`d` => 10] 
size 2:  [`a` => 5,`b` => 6]     [`a` => 5,`c` => 8]
         [`a` => 5,`d` => 10]    [`b` => 6,`c` => 8]
         [`b` => 6,`d` => 10]    [`c` => 8,`d` => 10] 
size 3:  [`a` => 5,`b` => 6,`c` => 8]
         [`a` => 5,`b` => 6,`d` => 10]
         [`a` => 5,`c` => 8,`d` => 10]
         [`b` => 6,`c` => 8,`d` => 10] 
size 4:  [`a` => 5,`b` => 6,`c` => 8,`d` => 10]
```

##### Retrieving combinations of a given length for a source data set.

```php
$sourceDataSet = ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10];

// Retrieve all combinations as Utility
$combinationsList = \Math\Combinatorics\Combination::get($sourceDataSet, 3);

// Retrieve all combinations as instance class
$combination      = new \Math\Combinatorics\Combination();
$combinationsList = $combination->getCombinations($sourceDataSet, 3);
```

Here is a detailed version of the expanded array

```
size 3:  [`a` => 5,`b` => 6,`c` => 8]
         [`a` => 5,`b` => 6,`d` => 10]
         [`a` => 5,`c` => 8,`d` => 10]
         [`b` => 6,`c` => 8,`d` => 10]
```


##### Retrieving all permutations for a source data set.

```php
$sourceDataSet = ['z' => 10, 'a' => 50, 'x' => 77];

// Retrieve all combinations as Utility
$permtuationList = \Math\Combinatorics\Permutation::get($sourceDataSet);

// Retrieve all combinations as instance class
$permutation      = new \Math\Combinatorics\Permutation();
$permutationsList = $combination->getPermutations($sourceDataSet);
```

Here is a detailed version of the expanded array

```
size 1:  ['z' => 10]
         ['a' => 50]
         ['x' => 77]
size 2:  ['z' => 10, 'a' => 50]
         ['a' => 50, 'z' => 10]
         ['z' => 10, 'x' => 77]
         ['x' => 77, 'z' => 10]
         ['a' => 50, 'x' => 77]
         ['x' => 77, 'a' => 50]
size 3:  ['z' => 10, 'a' => 50, 'x' => 77]
         ['z' => 10, 'x' => 77, 'a' => 50]
         ['a' => 50, 'x' => 77, 'z' => 10]
         ['a' => 50, 'z' => 10, 'x' => 77]
         ['x' => 77, 'z' => 10, 'a' => 50]
         ['x' => 77, 'a' => 50, 'z' => 10]
```

##### Retrieving permutations of a given length for a source data set.

```php
$sourceDataSet = ['z' => 10, 'a' => 50, 'x' => 77];

// Retrieve all combinations as Utility
$permtuationList = \Math\Combinatorics\Permutation::get($sourceDataSet, 2);

// Retrieve all combinations as instance class
$permutation      = new \Math\Combinatorics\Permutation();
$permutationsList = $combination->getPermutations($sourceDataSet, 2);
```

Here is a detailed version of the expanded array

```
size 2:  ['z' => 10, 'a' => 50]
         ['a' => 50, 'z' => 10]
         ['z' => 10, 'x' => 77]
         ['x' => 77, 'z' => 10]
         ['a' => 50, 'x' => 77]
         ['x' => 77, 'a' => 50]
```


## Install

The easiest way to install is through [composer](http://getcomposer.org).

Just create a composer.json file for your project:

```JSON
{
    "require": {
        "alphazygma/combinatorics": "~1.0"
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
