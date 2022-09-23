<?php

$data = [1, 1., NULL, new stdClass(), 'foo'];

foreach ($data as $value) {
	echo gettype($value);

	if (gettype($value) == "object"){
		echo "/className: " . get_class($value);
	}

	echo PHP_EOL;
}


# Dato un array disorganizzato come il seguente:

$addresses = array(
	'via tal dei tali 1, 20100 Milano (MI) Italia',
	['via tal dei tali 2', 'Genova', 'GE', '10000', 'Italia'],
	2,
	null,
	new stdClass(),
	['Mario', 'Rossi']
);

# stampare l'indirizzo nel caso la prop sia una stringa, o un array organizzato propriamente...

foreach ($addresses as $address){

	if (!(is_string($address) or is_array($address))){
		continue;
	}

	if (is_string($address))
		echo $address . PHP_EOL;

	if (is_array($address) && count($address) == 5){
		[$street, $city, $state, $cap, $country] = $address;
		echo "$street, $cap $city ($state) $country" . PHP_EOL;
	}

}


