<?php

# 1 -2 -3 -4 -5 -6 -7 -8 -9 -10

for ( $i = 0; $i < 10; $i ++ ) {

	if ( $i > 0 ) {

		echo "-";

	}
// $i = $i + 1; no
	echo $i + 1;

}

echo PHP_EOL;

for ( $i = 1; $i <= 10; $i ++ ) {

	if ( $i > 1 ) {

		echo "-";

	}

	echo $i;

}