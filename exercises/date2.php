<?php

/**
 * Gives back the date interval between the next BIRTHDAY and the current time
 *
 * @param DateTime $birthdate
 *
 * @return DateInterval
 */
function birthdayCountdown( DateTime $birthdate ): DateInterval {

	define( "MONTH_FMT", 'n' );
	define( "DAY_FMT", 'j' );
	define( "YEAR_FMT", 'Y' );

	$today         = new DateTime( 'now' );
	$todayYear     = $today->format( YEAR_FMT );
	$todayMonth    = $today->format( MONTH_FMT );
	$todayDay      = $today->format( DAY_FMT );

	$birthday      = new DateTime();
	$birthdayMonth = $birthdate->format( MONTH_FMT );
	$birthdayDay   = $birthdate->format( DAY_FMT );

	$birthday->setDate( $todayYear, $birthdayMonth, $birthdayDay );

	if ( $birthdayMonth <= $todayMonth && $birthdayDay < $todayDay ) {

		$birthday->modify( '+ 1 year' );
	}

	return $birthday->diff( $today );
}

$bdown = birthdayCountdown(DateTime::createFromFormat('d-m-Y', '21-09-1981'));

echo PHP_EOL;

print_r($bdown->days);