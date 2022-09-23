<?php

//$array = array("really long string here, boy", "this", "middling length", "larger");
//
//usort($array, function($a, $b) {
//	return strlen($a) - strlen($b);
//});
//
//print_r($array);

# INCLUDE PROPERTIES
//
//$array = array("really long string here, boy", "this", "middling length",
//	"larger");
//$sortOption = 'random';
//
//usort($array, function($a, $b) use ($sortOption)
//{
//	if ($sortOption == 'random') {
//		// sort randomly by returning (-1, 0, 1) at random
//		return rand(0, 2) - 1;
//	}
//	else {
//		return strlen($a) - strlen($b);
//	}
//});
//
//print_r($array);

# INTERESTING

$array = array( "really long string here, boy", "this", "middling length", "larger" );

$sortOption = "random";

function sortNonrandom( $array, callable $sortLogic ): void {
	$sortOption = false; # not used
	usort( $array, $sortLogic ); # sortOption is taken from an external context
	print_r( $array );
}

sortNonrandom( $array, function ( $a, $b ) use ( $sortOption ) {
	if ( $sortOption == "random" ) {
		// sort randomly by returning (-1, 0, 1) at random
		return rand( 0, 2 ) - 1;
	} else {
		return strlen( $a ) - strlen( $b );
	}
} );