<?php

/**
 * Gets new db connection
 *
 * @param string $host
 * @param string $port
 * @param string $user
 * @param string $password
 * @param string $db
 *
 * @return mysqli|null
 */
function connectMySQLi( string $host, string $port, string $user, string $password, string $db ): ?mysqli {
	try {
		return new mysqli( $host, $user, $password, $db, $port );
	} catch ( Exception $exception ) {

		addErrorToLog( $exception->getMessage() );
		addErrorToLog( func_get_args() );

		return null;
	}
}

/**
 * Helps to close db connection
 *
 * @param mysqli $db
 *
 * @return void
 */
function closeMySQLi( mysqli $db ): void {
	$db->close();
}