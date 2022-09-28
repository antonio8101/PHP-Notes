<?php

function startSession( ?array $initialSessionData = null ): void {
	session_start();

	if ( any( $initialSessionData ) ) {
		foreach ( $initialSessionData as $key => $value ) {
			$_SESSION[ $key ] = $value;
		}
	}

//	var_dump($_SESSION);

}

function endSession(): void {
	session_destroy();
}

function any( ?array $array ) {
	return ( ! is_null( $array ) && count( $array ) > 0 );
}