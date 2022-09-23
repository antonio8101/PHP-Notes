<?php

## REFERENCE PARAM

$a = 1;

function doubler( int &$value ): void {

	$value = $value << 1;

}

doubler($a);

echo $a . PHP_EOL;

## REFERENCE PARAM ON REFERENCE TYPE

class Human {

	public string $name;

}

$h = new Human();
$h->name = "Matisse";

assignName($h, "Birra");

echo $h->name . PHP_EOL;

function assignName( Human &$human, string $new_name ): void {

	$human = new Human();
	$human->name = $new_name;

}