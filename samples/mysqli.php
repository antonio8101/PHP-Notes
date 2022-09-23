<?php




# DATABASE CONNECTION

function connectDatabase(): mysqli {

	$config           = new stdClass();
	$config->host     = "host.docker.internal";
	$config->port     = 3306;
	$config->db       = "sakila";
	$config->user     = "root";
	$config->password = "root";
	$config->options  = [];

	try {

		return new mysqli($config->host, $config->user, $config->password, $config->db, $config->port);

	} catch ( Exception $exception ) {

		echo "Connection error ".$exception->getMessage();

		throw $exception;

	}

}

function closeConnectionDatabase(mysqli $connection): void{

	$connection->close();

}

class Actor{

}

try {

	$conn = connectPDO();

	echo "connessione effettuata";

	$stmt = $conn->prepare("INSERT INTO actor (first_name, last_name) VALUES (?, ?)");

	$firstname = "John";
	$lastname = "Doe";

	$stmt -> execute([$firstname, $lastname]);

	$firstname = "Mary";
	$lastname = "Moe";

	$stmt -> execute([$firstname, $lastname]);

	echo "New records created successfully";

	closeConnectionDatabase($conn);

} catch ( Exception $e ) {

	die("statement failed");

}