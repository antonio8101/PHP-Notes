<?php

/**
 * Returns date in different formats as string
 *
 * @return string
 */
function printCurrentDateTime(): string{

	$now = time();

	$print = date('Y/m/d', $now);
	$print .= PHP_EOL;
	$print .= date('d.m.y', $now);
	$print .= PHP_EOL;
	$print .= date('d-m-y', $now);

	return $print;
}

echo PHP_EOL;

print_r(printCurrentDateTime());