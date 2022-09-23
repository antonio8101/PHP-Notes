<?php

function saveActor(Actor $actor): PDOStatement{

	$db    = connectPDO();

	$query = "INSERT INTO actor (first_name, last_name) 
			VALUES (?, ?)";

	$statement = $db->prepare( $query );

	$statement->execute( array( $actor->name, $actor->lastName) );

	return $statement;
}

$insertStatement = saveActor(new Actor("Lino", "Banfi"));

echo "<pre>";
$insertStatement->debugDumpParams();
echo "</pre>";

die();

# DATABASE CONNECTION


function connectDatabase(): PDO{

	$config           = new stdClass();
	$config->host     = "host.docker.internal";
	$config->port     = 3306;
	$config->db       = "sakila";
	$config->user     = "root";
	$config->password = "root";
	$config->options  = [];

	try {

		$conn = new PDO( "mysql:host={$config->host};dbname={$config->db}",
			$config->user,
			$config->password,
			$config->options );

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;

	} catch ( PDOException $exception ) {

		echo "Connection error ".$exception->getMessage();

		throw $exception;

	}

}

$dbConnection = connectPDO();


## SELECT STATEMENT EXAMPLE WITH PARAMETERS 2

function filterActor(string $firstName, string $lastName): PDOStatement {

	$db      = connectPDO();
	$query   = "SELECT * FROM actor WHERE first_name LIKE ? AND last_name LIKE ?";
	$options = [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]; # optional

	$statement = $db->prepare( $query, $options );

	$statement->execute(array($firstName, $lastName));

	return $statement;

}

$actors = [
	["Renato", "Pozzetto"],
	["Paolo", "Villaggio"]
];

foreach ($actors as $a){

	$s = filterActor($a[0], $a[1]);

	while ($row = $s->fetch()){

		echo "<pre>";
		print_r( $row );
		echo "</pre>";

	}

}


die();




## INSERT STATEMENT

class Actor {

	public function __construct(string $actor, string $lastName) {

		$this->name = $actor;
		$this->lastName = $lastName;

	}

	public string $name;

	public string $lastName;

}



# TRANSACTION

try {

	$db = connectPDO();

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->beginTransaction();

	$db->exec("INSERT INTO actor (first_name, last_name) VALUES ('Renato', 'Pozzetto')");
	$db->exec("INSERT INTO actor (first_name, last_name) VALUES ('Adriano', 'Celentano')");

	$db->commit();

} catch (Exception $error){

	$db->rollBack();

	echo "Transaction aborted: " . $error->getMessage();

}