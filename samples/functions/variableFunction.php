<?php


# SCENARIO...

function first(int $s, string $t): string {
	echo $s . PHP_EOL;
	echo $t . PHP_EOL;
	return 'first';
}

function second(): string {
	return 'second';
}

function third(): string {
	return 'third';
}

$which = 'first';

switch ($which) {
	case 'first':
		//echo first();
		break;
	case 'second':
		echo second();
		break;
	case 'third':
		echo third();
		break;
}




# VARIABLE FUNCTION

$which = 'first';

echo $which(0, "test");