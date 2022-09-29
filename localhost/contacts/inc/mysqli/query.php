<?php

function searchContacts( mysqli $db, ?string $text = null ): mysqli_result|bool {

	try {

		if ( ! hasData( $text ) ) {
			return getContacts( $db );
		}

		$query = $db->prepare( "
							SELECT * FROM contacts WHERE 
                           	active = 1 AND
                           	MATCH(name,surname,email) AGAINST (? IN BOOLEAN MODE);" );

		$queryParams = [ '*' . $text . '*' ];

		$query->execute( $queryParams );

		return $query->get_result();
	} catch ( Exception $exception ) {
		addErrorToLog( $exception->getMessage() );

		return false;
	}
}

function getContacts( mysqli $db ): mysqli_result|bool {
	return $db->query( 'SELECT * FROM contacts WHERE active = 1' );
}

function getContact( mysqli $db, string $contactId ): ?array {

	try {

		$query = $db->prepare( "SELECT * FROM contacts WHERE id = ?" );

		$query->execute( [ $contactId ] );

		$result = $query->get_result();

		return $result->fetch_assoc();

	} catch ( Exception $exception ) {

		addErrorToLog( $exception->getMessage() );

		return null;
	}

}