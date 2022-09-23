<?php
//phpinfo();

// var_dump(get_loaded_extensions());

//var_dump(get_extension_funcs('ftp'));



array(
	'fdlfdlfdkdlklfkdlkflkX' => NULL,
	'fdlfdlfdkdlklfkdlkflk1' => 11,
	'$var'   => 'fdlfdlfdkdlklfkdlkflkX'
);

#'fdlfdlfdkdlklfkdlkflkd' => 10,
#'fdlfdlfdkdlklfkdlkflk2' => 10,
#'$myVar' => 'fdlfdlfdkdlklfkdlkflk2',

$var = 10;

$myVar = $var;

// write...
$var++;

echo $myVar;

unset($myVar);
//var_dump(isset($var));
//var_dump(isset($myVar));
$var1 = null;
var_dump(isset($var1));


$var2 = "";
var_dump(empty($var2));

$test = "2";
var_dump(is_int($test));


function myFunc(){

}

$myFuncVar = "myFunc";

var_dump(is_callable($myFuncVar));

$myFuncVar();

//$testArr = "";
//$testArr = array();
//$testArr = 1000;
//$testArr = null;
//$testArr = new stdClass();
//var_dump(count($testArr));

class Test implements Countable {

	public function count(): int {
		return 0;
	}
}

$t = new Test();

$testArr = false;

var_dump(is_countable($t));


var_dump(strval(5959));

$var = "test";
$var3   = array("1");
//var_dump(settype( $var3, "string" ));

$var4 = (string) $var3;

var_dump($var4);

