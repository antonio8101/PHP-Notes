<?php

/**
 * Create new entry in contacts table
 *
 * @param PDO $db
 * @param array $params
 *
 * @return bool
 */
function createContact(PDO $db, array $params): bool {

	try {

		$command = "INSERT INTO contacts (name, phone_number, email, surname, company, role, picture)
					VALUES (?, ?, ?, ?, ?, ?, ?)";

		$statement = $db->prepare($command);

		$name         = array_key_exists( 'name', $params ) ? $params['name'] : throw new Exception( 'Name is mandatory' );
		$phone_number = array_key_exists( 'phone', $params ) ? $params['phone'] : throw new Exception( 'Phone is mandatory' );
		$email        = array_key_exists( 'email', $params ) ? $params['email'] : throw new Exception( 'Email is mandatory' );
		$surname      = array_key_exists( 'surname', $params ) ? $params['surname'] : null;
		$company      = array_key_exists( 'company', $params ) ? $params['company'] : null;
		$role         = array_key_exists( 'role', $params ) ? $params['role'] : null;
		$picture      = array_key_exists( 'picture', $params ) ? $params['picture'] : null;

		$statement->execute([
			$name,
			$phone_number,
			$email,
			$surname,
			$company,
			$role,
			$picture
		]);

		return true;

	} catch (Exception $e){

		addErrorToLog($e->getMessage());
		addErrorToLog($params);

		return false;

	}

}