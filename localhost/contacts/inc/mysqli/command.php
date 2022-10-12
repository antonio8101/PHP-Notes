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
			"INSERT INTO contacts (name, phone_number, email, surname, company, role, picture_id)
					VALUES (?, ?, ?, ?, ?, ?, ?)" );

		$name         = array_key_exists( 'name', $params ) ? $params['name'] : throw new Exception( 'Name is mandatory' );
		$phone_number = array_key_exists( 'phone', $params ) ? $params['phone'] : throw new Exception( 'Phone is mandatory' );
		$email        = array_key_exists( 'email', $params ) ? $params['email'] : throw new Exception( 'Email is mandatory' );
		$surname      = array_key_exists( 'surname', $params ) ? $params['surname'] : null;
		$company      = array_key_exists( 'company', $params ) ? $params['company'] : null;
		$role         = array_key_exists( 'role', $params ) ? $params['role'] : null;
		$picture_id   = array_key_exists( 'picture_id', $params ) ? $params['picture_id'] : null;

		$statement->execute( [
			$name,
			$phone_number,
			$email,
			$surname,
			$company,
			$role,
			$picture_id
		] );

		return true;

	} catch ( Exception $e ) {

		addErrorToLog( $e->getMessage() );
		addErrorToLog( implode( ',', $params ) );

		return false;

	}

}

function deleteContact( mysqli $db, string $contactId, string $email ): bool {

	try {
		$statement = $db->prepare( "UPDATE contacts SET active = 0, email = ? WHERE id = ?" );

		$statement->execute( [
			$email,
			$contactId
		] );

		return true;

	} catch ( Exception $e ) {

		addErrorToLog( $e->getMessage() );

		return false;

	}
}

function insertImage( mysqli $db, string $image ): int{
	try {
		$query = "INSERT INTO pictures (content) VALUES(?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param('s', $image);
		$stmt->execute();
		$id = $db->insert_id;

		return $id;

	} catch (Exception $e){

		addErrorToLog( $e->getMessage() );

		return false;
	}
}
