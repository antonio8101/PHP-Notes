<?php

session_start();

$_SESSION['hits'] = (array_key_exists('hits', $_SESSION) ? $_SESSION['hits'] : 0) + 1;

echo "This page has been viewed {$_SESSION['hits']} times";


//session_destroy();

###

if (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] !== 'on'){
	die("Must be a secure connection.");
}

