<?php

$colors = array( 'white', 'green', 'red', 'blue', 'black' );

echo "colors in-line: ";

foreach ($colors as $key => $color) {

	if ($key > 0) echo ", ";

	echo $color;
}

echo PHP_EOL;
echo PHP_EOL;

echo "colors in-column:";

foreach ($colors as $key => $color) {

	if ($key > 0) echo PHP_EOL;

	echo $color;
}