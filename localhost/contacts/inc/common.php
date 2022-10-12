<?php

/** SERVICES */
require_once "services/ImageService.php";

startSession( $_POST );

function getProfileImage( array $contact ): string | null {

	$nameInitial        = $contact['name'][0];
	$surnameInitial     = substr( $contact['surname'], 0, 1 );
	$placeHolderContent = "https://via.placeholder.com/150/0000FF/808080?text={$nameInitial}{$surnameInitial}";

	$db = connectMySQLi( DB_HOST, DB_PORT, DB_USER, DB_USER, DB_NAME );

	$imageService = new ImageDbService($db);

	$profileImage = $imageService->get($contact['picture_id']) ?? $placeHolderContent;

	$db->close();

	return $profileImage;
}