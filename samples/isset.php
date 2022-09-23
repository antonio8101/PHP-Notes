<?php

$a = "some value";

var_dump(isset($a));      // TRUE

$b = "some other value";

var_dump(isset($a, $b)); // TRUE

unset($a);

var_dump(isset($a));     // FALSE
var_dump(isset($a, $b)); // FALSE

$foo = NULL;
var_dump(isset($foo));   // FALSE


# ARRAY

$colors = ["red", "green", "blue"];

var_dump(isset($colors[2])); // TRUE

unset($colors[2]);

var_dump(isset($colors[2])); // FALSE

unset($colors[0]);

print_r($colors);

# OBJECT

class SomeClass {
	public string $prop;

	public function __construct() {
		$this->prop = "some value";
	}
}

$someClass = new SomeClass();

var_dump(isset($someClass->prop)); // TRUE

unset($someClass->prop);

var_dump(isset($someClass->prop)); // FALSE
