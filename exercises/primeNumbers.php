<?php


function getPrimeInRangeNumbers(int $startNumber, int $count = 10): array {

	$primeNumbers = array();

	$endNumber = $startNumber + $count;

	for ($i = $startNumber; $i <= $endNumber; $i++){

		$isPrime = isPrime($i);

		if ($isPrime){

			$primeNumbers[] = $i;

		}

	}

	return $primeNumbers;

}


function isPrime( int $number ): bool {

	if ( $number == 1 ) {
		return 1;
	}

	for ( $i = 2; $i <= $number / 2; $i ++ ) {

		if ( $number % $i == 0 ) {

			return 0;

		}
	}

	return 1;

}


$numbers = getPrimeInRangeNumbers(0, 1000);

var_dump($numbers);