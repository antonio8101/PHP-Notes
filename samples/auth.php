<?php

$authOK = false;

$user = array_key_exists('PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : null;
$password = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : null;

if (isset($user) && isset($password) && $user === strrev($password)) {
	$authOK = true;
}

if (!$authOK) {
	header('WWW-Authenticate: Basic realm="Top Secret Files"');
	header('HTTP/1.0 401 Unauthorized');

	// anything else printed here is only seen if the client hits "Cancel"
	exit;
}

?>

<!-- your password-protected document goes here -->

contenuto riservato


