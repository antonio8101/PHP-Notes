<?php

class MyPDO extends PDO{

	const PDOX = "FFF";

	public string $varx;

	public function __construct($host, $dbname, $user, $password, $port=3306) {
		$dsn= "mysql:host={$host};port={$port};dbname={$dbname}";
		$options = [];
		parent::__construct( $dsn, $user, $password, $options );
	}

	public static function something(){

	}

	public static function  somethingElse(){

	}

}

class Helper{

	public static function fixThis(){

	}
	public static function fixThis1(){

	}
	public static function fixThis2(){

	}
	public static function fixThis3(){

	}
	public static function fixThis4(){

	}
	public static function fixThis5(){

	}
}

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
function connectPDO( $host, $dbname, $user, $password, $port = 3306 ): ?MyPDO {
	try {

		// istanza
		$pdo = new PDO();

		//$pdo->varx;


		// classe
		Helper::fixThis1();
		MyPDO::somethingElse();
		MyPDO::something();


		return null;
		//return $pdo;
	} catch ( Exception $e ) {

		addErrorToLog( $e->getMessage() );

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