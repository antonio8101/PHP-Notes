<?php

$var = false;

// Evaluates to true because $var is empty
if (empty($var)) {
	echo '$var is either 0, empty, or not set at all' . PHP_EOL;
}

// Evaluates as true because $var is set
if (isset($var)) {
	echo '$var is set even though it is empty' . PHP_EOL;
}


if (is_numeric($var)){
	echo "\$var è numeric!!";
}


function someThing(bool $something = null){
	if (is_bool($something)){
		return "SI";
	}

	return "no";
}

echo something();