# COMBINATORICS

- - -
**PORT IN PROGRESS**
- - -
 
A Math library to calculate the Combinations of a given set (array of values).

This version is the isolated functionality to calculate Combinations and Permutations
(I'll be porting Permutations soon).


## Disclosure

This is based on the work of _David Sanders_ (<shangxiao@php.net>) with a variant approach.

Source PEAR package: <https://pear.php.net/package/Math_Combinatorics>
Source Git package: <https://packagist.org/packages/pear/math_combinatorics>


## Combinations

This version is similar to David's with the difference that the base method will return all 
possible combinations based on the supplied set.

It also provides with a Static method to access the class as a utility, so if you need this
functionality very often, use the Instance approach for you'll get better performance, but if
you use it here and there, the static access may prove more readable.

Additionally, it detaches the Pointers functionality into it's own class, providing a bit more
clarity into the Combinations code as well as making it better thread-safe as the pointers
are no longer an attribute of the class shared across the methods, it is an object created
for each run and thus allowing to run multiple combinations in parallel from the same class
instance without having them interfere with each other.


## Changelog

 - Porting (not ready for production use yet)


## License

GNU LGPLv.3


## Usage

add this section !


## Install

add this section !
