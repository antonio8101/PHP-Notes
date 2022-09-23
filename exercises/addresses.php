<?php

$address = array(
	'via tal dei tali 1, 20100 Milano (MI) Italia',
	['via tal dei tali 2', 'Genova', '(GE)', '10000', 'Italia'],
	2,
	null,
	new stdClass(),
	['Mario', 'Rossi']
);

function printAddress(array $rowData): void{

	$finalData = array();

	foreach($rowData as $data){

		if (is_string($data))
			$finalData[] = $data;

		if (is_array($data) && count($data) == 5){
			$finalData[] = implode(" ", $data);
		}
	}

	echo implode(PHP_EOL, $finalData);


//	foreach($rowData as $data){
//
//		if (is_string($data))
//			echo $data;
//
//		if (is_array($data) && count($data) == 5)
//			echo implode(" ", $data);
//
//		if (is_numeric($data) ||
//			is_null($data) ||
//		    is_array($data) && count($data) != 5 ||
//		    is_object($data))
//			continue;
//
//		echo PHP_EOL;
//	}
}

printAddress($address);