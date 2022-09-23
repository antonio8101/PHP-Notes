<?php

function myTest(): void {
	static $x = 5;
	$x ++;
	echo "Value of X is " . $x . PHP_EOL;
}

myTest();
myTest();
myTest();
myTest();

$ioSonoUnaVar  = "interpolata";
$ioSonoUnArray = array( "test" );
$ioSonoUnArray = array( "test" => "test" );
echo "Stringa 1 \"citazione\" $ioSonoUnaVar" . PHP_EOL;
echo "Stringa 1 \"citazione\" $ioSonoUnaVar[0]" . PHP_EOL;
//echo "Stringa 1 \"citazione\" $ioSonoUnaVar['test']" . PHP_EOL;
echo 'Stringa 2 "citazione" l\'albero ' . $ioSonoUnaVar . PHP_EOL;
var_dump( $ioSonoUnaVar );


$t = 10;
$t += 4;
var_dump( $t );

$n    = "John";
$c    = "Doe";

$name = $n . " " . $c;

var_dump( $name );

var_dump( "1" == 1 && 2 == "2" );
var_dump( "1" == 1 and 2 == "2" );
var_dump( "1" == 1 || 2 == "2" );
var_dump( "1" == 1 or 2 == "2" );
var_dump( "1" == 1 or  (2 == "2") );
var_dump( "1" == 1 xor  (2 == "2") );
var_dump( "1" === 1 );
var_dump( "1" !== 1 );
var_dump( 3 <=> 2 );
var_dump( 3 <=> 4 );