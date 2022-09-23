<?php

class Entertainment {}

class Clown extends Entertainment {}

class Job {}

function handleEntertainment(Entertainment $a, callable $callback = NULL): void {
	echo "Handling " . get_class($a) . " fun\n";

	if ($callback !== NULL) {
		$callback();
	}
}

$callback = function()
{
	// do something
};

handleEntertainment(new Clown); // works
handleEntertainment(new Clown, $callback); // works
handleEntertainment(new Job); // error

