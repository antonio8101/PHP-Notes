<?php

// An example callback function
function my_callback_function() {
	echo 'GLOBAL FUNCTION!' . PHP_EOL;
};

// Type 1: Simple callback
var_dump(is_callable('my_callback_function', true));
call_user_func('my_callback_function');

// An example callback method
class MyClass {
	static function myCallbackMethod() {
		echo 'OBJECT METHOD!' . PHP_EOL;
	}
}

// Type 2: Object method call
var_dump(is_callable(array('MyClass', 'myCallbackMethod')));
call_user_func(array('MyClass', 'myCallbackMethod'));

// Type 3: Callbacks
# usage of syntax only
$callback = function () {
	echo 'CALLBACK RESULT!' . PHP_EOL;
};

echo 'CALLBACK!' . PHP_EOL;
var_dump(is_callable($callback));
var_dump(is_callable($callback));
$callback();
call_user_func($callback);

