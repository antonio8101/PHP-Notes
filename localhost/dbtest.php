<?php

$host = isWindowsServer() ?
	'localhost' :
	'host.docker.internal';

$dbName = 'sakila';
$user = 'root';
$password = 'root';
$option = [];

function connectDb(
	string $host,
	string $dbName,
	string $user,
	string $password,
	array  $option = null
) {

	$connectionString = "mysql:host={$host};dbname={$dbName}";

	try {
		$conn = new PDO($connectionString, $user, $password, $option);

		$conn->setAttribute(
			PDO::ATTR_ERRMODE,
			PDO::ERRMODE_EXCEPTION);

		if (is_null($conn)) {
			throw new Exception('connection failed');
		}

		return $conn;

	} catch (Exception $exception) {

		die($exception->getMessage());

	}
}

$db = connectDb($host, $dbName, $user, $password);

$actorsDs      = getAllActors( $db );
$actorsDsCount = getNumberOfActors( $db );

$actors = $actorsDs->fetchAll();

$name = 'ezio';
$lastname = null;

//insertNewActor($db, 'Ezio', 'Greggio');
//insertNewActor($db, 'Paolo', 'Bisio');

$searchDs = hasData($lastname) == 0 ?
	searchActorByName( $db, $name ) :
	searchActorByNameAndLastName($db, $name, $lastname);

//echo '<pre>' . $searchDs->debugDumpParams() . '</pre>';

$actors   = $searchDs->fetchAll();

echo 'Numero degli actors with name <u>' . $name . '</u> : ' . count($actors) . '/' .$actorsDsCount;

foreach ( $actors as $actor ) {
	echo '<pre>';
	print_r( $actor );
	echo '</pre>';
}



/*
while($row = $actorsDs->fetch()){
	echo '<pre>';
	print_r($row);
	echo '</pre>';
}
*/


function getAllActors(PDO $db): bool|PDOStatement{
	$query = 'SELECT * FROM actor';
	$options = [PDO::ATTR_CURSOR, PDO::CURSOR_FWDONLY];

    $statement = $db->prepare($query, $options);
    $statement->execute();

    return $statement;
}

function getNumberOfActors(PDO $db): int{
	$query = 'SELECT count(*) FROM actor';
	$options = [PDO::ATTR_CURSOR, PDO::CURSOR_FWDONLY];

	$statement = $db->prepare($query, $options);
	$statement->execute();

	return (int) $statement->fetchColumn();
}

function searchActorByName(PDO $db, string $name): bool|PDOStatement {

	$query = 'SELECT * FROM actor WHERE first_name LIKE :param1';
	$options = [PDO::ATTR_CURSOR, PDO::CURSOR_FWDONLY];

	$statement = $db->prepare($query, $options);
	$statement->execute(['param1' => "%{$name}%"]);

	return $statement;
}

function searchActorByNameAndLastName(PDO $db, string $name, string $lastName): bool|PDOStatement {

	$query = 'SELECT * FROM actor WHERE first_name LIKE ? AND last_name LIKE ?';
	$options = [PDO::ATTR_CURSOR, PDO::CURSOR_FWDONLY];

	$statement = $db->prepare($query, $options);
	$statement->execute(["%{$name}%", "%{$lastName}%"]);

	return $statement;
}

function insertNewActor( PDO $db, $firstName, $lastName ): void {
	$query     = 'INSERT INTO actor (first_name, last_name) VALUES (?,?) ';
	$statement = $db->prepare( $query );
	$statement->execute( [ $firstName, $lastName ] );
}

function isWindowsServer(): bool {
	if ( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'WIN' ) {
		return true;
	} else {
		return false;
	}
}

function hasData( $lastname ): bool {

	if (is_null($lastname))
		return false;

	if (strlen($lastname) == 0)
		return false;

	return true;
}