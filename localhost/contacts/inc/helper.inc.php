<?php

function hasData( ?string $str ): bool {

	if ( is_null( $str ) ) {
		return false;
	}

	if ( strlen( $str ) == 0 ) {
		return false;
	}

	return true;
}

function getPageTitle( ?string $sectionTitle = null ): string {

	$pageTitle   = "Contacts";
	$scriptName  = getScriptNameFromServerVariables();
	$sectionName = hasData( $sectionTitle ) ? $sectionTitle : $scriptName;
	$sectionName = ucfirst( $sectionName );
	$pageTitle   .= " | $sectionName";

	return $pageTitle;
}

function getScriptNameFromServerVariables(): array|string {
	$scriptArr  = explode( '\\', $_SERVER['SCRIPT_FILENAME'] );
	$scriptName = str_replace( '.php', '', $scriptArr[ array_key_last( $scriptArr ) ] );

	return $scriptName;
}

function addErrorToLog(string $error): void{

	if (!array_key_exists('errors', $_SESSION) || is_null($_SESSION['errors'])){
		$_SESSION['errors'] = [];
	}

	$_SESSION['errors'][] = $error;
}

function getLog(): string{

	if (!array_key_exists('errors', $_SESSION)){
		return '';
	}

	return implode('<br>', $_SESSION['errors']);
}