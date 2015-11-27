# attribute-hashing
Allows you to define what attributes in your Eloquent Model which should be hashed.

## Installing

Install using Composer `composer require larapack/attribute-hashing 1.*`.

## Usage

First add the traits `Manipulateable` and `Hashable` to your Eloquent Model.
```
<?php

namespace App;

use Larapack/AttributeManipulating/Manipulateable;
use Larapack/AttributeHashing/Hashable;

class User
{
  use Manipulateable;
  use Hashable;
  
  /**
   * @var array List of attribute names which should be hashed
   */ 
  protected $hash = ['password']; // set the attribute names you which to hash
  
  //...
}
```

Now whenever you set the attribute `password` it will now be hashed.

Test:
```
$user = new App\User;
$user->password = 'secret';
echo $user->password // Here you will see the encrypted password
```
