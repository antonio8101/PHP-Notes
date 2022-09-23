<?php

function sum( $p1, ?int $p2 = 0): ?int {

	$count = 0;
	$args  = func_get_args();

	foreach ( $args as $arg ) {

		$count += $arg;

	}

	return null;
}


echo sum(4, null);