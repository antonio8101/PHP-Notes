<?php

$frutti = array('Banana', 'Mela', 'Pera');
$frutti[] = 'Anguria';
$frutti[3] = 'kiwi';
$frutti[3] = NULL;

# unset e remap
unset($frutti[3]);
//$frutti = array_values($frutti);

# unset e remap
unset($frutti[0]);
//$frutti = array_values($frutti);

var_dump($frutti);

# set e remap
$frutti[5] = 'Ananas';
//$frutti = array_values($frutti);

$frutti[] = 'Pesca';

var_dump($frutti);

$frutti = array_slice($frutti, 0, count($frutti));

var_dump($frutti);

$arrayLength = count($frutti);

echo "Array length: {$arrayLength}" . PHP_EOL;

for ($i = 0; $i < count($frutti); $i++){
	echo $frutti[$i] . PHP_EOL;
}

var_dump(in_array('Kiwi', $frutti));

$yesNo = in_array('Kiwi', $frutti) ? 'Si' : 'No';

echo 'Presente kiwi: ' .  $yesNo;

$keys = array_keys($frutti);

var_dump($keys);


$frutti = ['frutto0' => 'Mela', 'frutto1' => 'Banana', 'frutto3' => 'Pesca'];
$fruttiKeys = array_keys($frutti);

$isKeyDefined = in_array('frutto3', $fruttiKeys);

if ($isKeyDefined){
	echo 'frutto3 è ' . $frutti['frutto3'];
}


var_dump($fruttiKeys);

for ($i = 0; $i < count($frutti); $i++) {
	$key = $fruttiKeys[$i];
	echo "Il frutto è " . $frutti[$key];
	echo PHP_EOL;
}

$frutti = array_merge(['test', 'test1'], $frutti);

$frutti[] = 'kiwi';

unset($frutti[0]);

$frutti = array_slice($frutti, 0); # reset degli indici numerici.. mantenendo gli indici testuali..

print_r($frutti);
print_r(count($frutti));
echo PHP_EOL;

foreach ($frutti as $key => $value){
	echo $key . " " . $value;
	echo PHP_EOL;
}

function sayHello(string $name = null): void{
	echo "Hello {$name}";
}

$name = "John";

sayHello();

