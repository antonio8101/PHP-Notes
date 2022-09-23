<?php

$a = 1;
$b = 10;
$c = 100;

$result = null;

if ( $a > $b ) {

	$result = ($a > $c) ? $a : $c;

}  else {

	$result = ($b > $c) ? $b : $c;

}


echo "Il maggiore dei 3 tra {$a}, {$b}, {$c} è: $result";