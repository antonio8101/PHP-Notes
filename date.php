<?php

function getCopyright( string $myCompany ): string {

	$year = date( 'Y', time() );

	return "Copyright {$year}  © {$myCompany} ";

}

echo getCopyright( "Coca cola" );

function getBirthdayCountdown(DateTime $birthdate): DateInterval{

	$today = new DateTime('now');
	$todayYear = (int) $today->format('Y');
	$todayMonth = (int) $today->format('n');
	$todayDay = (int) $today->format('j');

	$birthday = new DateTime();
	$birthdayDay = (int) $birthdate->format('j');
	$birthdayMonth = (int) $birthdate->format('n');

	if ($birthdayMonth < $todayMonth){
		$todayYear++;
	}

	if ($birthdayMonth == $todayMonth && $birthdayDay < $todayDay){
		$todayYear++;
	}

	$birthday->setDate($todayYear, $birthdayMonth, $birthdayDay);

	return $birthday->diff($today);
}

$dates = [
	'19-9-1980',
	'20-9-1980',
	'21-9-1980',
	'19-9-1980',
	'20-10-1980',
	'21-10-1980',
	'1-1-1980',
	'29-2-1980'
	];

foreach ($dates as $date){
	$interval = getBirthdayCountdown(
		DateTime::createFromFormat('j-n-Y', $date));
	$suffix = $interval->days > 1 ? 'i' : 'o';
	echo PHP_EOL;
	echo 'Al tuo compleanno manca ' . $interval->days . ' giorn' . $suffix;
}
