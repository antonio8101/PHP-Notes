<?php

require_once ("functions.php");

$a = 0;

function myFunc(string $funcName): void {

	if (!function_exists('newFoo')){

		function newFoo(){

			echo "io sono foo() in myFunc()";

		}

	}

	$myVar = $funcName;

	$myVar();

}

myFunc('function_exists');

myFunc('newFoo');
//myFunc('bar');
