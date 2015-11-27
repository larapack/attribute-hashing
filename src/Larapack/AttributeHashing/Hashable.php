<?php

namespace Larapack\AttributeHasing;

use Hash;
use Exception;
use Larapack\AttributeManipulation\Manipulateable;

trait Hashable
{
    /**
     * @var array List of attribute names which should be hashed
     * 
     * protected $hash = [];
     */
    
    /**
     * Boot the Hashable trait for a model.
     * @return void
     */
    public static function bootHashable()
    {
	    if (!isset(class_uses(get_called_class())[Manipulateable::class])) {
		    throw new Exception(sprintf('You must use the '.Manipulateable::class.' trait in %s to use the Hashable trait.', get_called_class()));
	    }
	    
	    static::addSetterManipulator(function($model, $key, $value) {
		    if (array_key_exists($key, array_flip($model->getHashAttributes()))) {
	            return $model->hash($value);
	        }
	        return $value;
	    });
    }
	
    /**
     * Encrypts an value.
     * @param  string $value Value to encrypt
     * @return string        Encrypted value
     */
    public function hash($value)
    {
        return Hash::make($value);
    }
    
    /**
     * Returns a collection of fields that will be encrypted.
     * @return array
     */
    public function getHashAttributes()
    {
	    if (property_exists(get_called_class(), 'hash')) {
        	return $this->hash;
        }
        
        return [];
    }
}
