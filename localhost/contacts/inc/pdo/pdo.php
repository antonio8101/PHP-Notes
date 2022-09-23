<?php

/**
 * Gets new db connection
 *
 * @param $host
 * @param $dbname
 * @param $user
 * @param $password
 *
 * @return PDO|null
 */
function connectPDO($host, $dbname, $user, $password): ?PDO {
	try {
		return new PDO( "mysql:host={$host};dbname={$dbname}",
			$user,
			$password,
			[]);
	} catch (Exception $e){

		var_dump($e->getMessage());

		return null;
	}
}

/**
 * Close PDO connection
 *
 * @param PDO $PDO
 *
 * @return void
 */
function closeConnection(PDO &$PDO): void {
	$PDO =  null;
}

//$db = connectPDO('localhost', 'test_app', 'root', 'root', []);
//
//if (is_null($db))
//	die('Connection failed');
//
//closeConnection($db);