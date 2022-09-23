<?php

//$db = mysqli_connect("localhost", "user", "pass");
//
//if (!$db){
//	die("Could not connect to Database");
//}


// COUNT

$frutti = [
	'frutto0' => 'Banana',
	'frutto1' => 'Mela',
	'frutto2' => 'Pera'
];

echo "Sono presenti " . count($frutti) . " frutti";

// IN ARRAY

$frutti = [
	'frutto0' => 'Banana',
	'frutto1' => 'Mela',
	'frutto2' => 'Pera'
];

$needle = "Banana";

echo in_array($needle, $frutti) ? "$needle è contenuto in array" : null;


// SHUFFLE

$numbers = range(1, 3);

echo "<pre>";
print_r($numbers);
echo "</pre>";

shuffle($numbers);

echo "<pre>";
print_r($numbers);
echo "</pre>";

// REVERSE

$numbers = range(1, 3);

echo "<pre>";
print_r($numbers);
echo "</pre>";

$numbers_reversed = array_reverse($numbers);

echo "<pre>";
print_r($numbers_reversed);
echo "</pre>";

// MERGE

$numbers = range(1, 3);

echo "<pre>";
print_r($numbers);
echo "</pre>";

$numbers_merged = array_merge($numbers, range(4, 6));

echo "<pre>";
print_r($numbers_merged);
echo "</pre>";


// SLICE

$numbers = range(1, 6);

echo "<pre>";
print_r($numbers);
echo "</pre>";

$numbers_sliced = array_slice($numbers, 0, 2);

echo "<pre>";
print_r($numbers_sliced);
echo "</pre>";

// KEYS & VALUES

$frutti = [
	'frutto0' => 'Banana',
	'frutto1' => 'Mela',
	'frutto2' => 'Pera'
];

echo "<pre>";
print_r($frutti);
echo "</pre>";

$frutti_keys = array_keys($frutti);
$frutti_values = array_values($frutti);

echo "<pre>";
print_r($frutti_keys);
echo "</pre>";
echo "<pre>";
print_r($frutti_values);
echo "</pre>";

function functionName(): void{
	// code to execute
}

functionName();

function writeName(string $name) : void {
	echo "Hello $name!!!";
}

writeName("John;");