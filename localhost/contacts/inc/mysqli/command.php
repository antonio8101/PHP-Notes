<?php


/**
 * Create new entry in contacts table
 *
 * @param mysqli $db
 * @param array $params
 *
 * @return bool
 */
function mysqliCreateContact( mysqli $db, array $params ): bool {

	try {

		$statement = $db->prepare(
			"INSERT INTO contacts (name, phone_number, email, surname, company, role, picture)
					VALUES (?, ?, ?, ?, ?, ?, ?)" );

		$name         = array_key_exists( 'name', $params ) ? $params['name'] : throw new Exception( 'Name is mandatory' );
		$phone_number = array_key_exists( 'phone', $params ) ? $params['phone'] : throw new Exception( 'Phone is mandatory' );
		$email        = array_key_exists( 'email', $params ) ? $params['email'] : throw new Exception( 'Email is mandatory' );
		$surname      = array_key_exists( 'surname', $params ) ? $params['surname'] : null;
		$company      = array_key_exists( 'company', $params ) ? $params['company'] : null;
		$role         = array_key_exists( 'role', $params ) ? $params['role'] : null;
		$picture      = array_key_exists( 'picture', $params ) ? $params['picture'] : null;

		$statement->execute( [
			$name,
			$phone_number,
			$email,
			$surname,
			$company,
			$role,
			$picture
		] );

		return true;

	} catch ( Exception $e ) {

		addErrorToLog( $e->getMessage() );
		addErrorToLog( implode( ',', $params ) );

		return false;

	}

}

function deleteContact( mysqli $db, string $contactId ): bool {

	try {
		$statement = $db->prepare( "UPDATE contacts SET active = 0 WHERE id = ?" );

		$statement->execute( [
			$contactId
		] );

		return true;

	} catch ( Exception $e ) {

		addErrorToLog( $e->getMessage() );
		addErrorToLog( implode( ',', $params ) );

		return false;

	}
}
