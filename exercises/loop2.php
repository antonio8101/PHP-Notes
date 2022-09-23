<?php

$result     = 0;
$lowerLimit = 0;
$upperLimit = 30;

for ( $i = $lowerLimit; $i <= $upperLimit; $i ++ ) {

	$result += $i;

}

echo "La somma dei numeri interi da 0 a {$upperLimit} è {$result}";