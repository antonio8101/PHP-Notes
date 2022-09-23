<?php

require_once "inc/config.inc.php";
require_once "inc/pdo/pdo.php";
require_once "inc/pdo/command.php";
//require_once "inc/mysqli/mysqli.php";
//require_once "inc/mysqli/command.php";
require_once "inc/session.php";

if ( function_exists( 'startSession' ) ) {
	startSession( $_POST );
}

$invalidFields = getInvalidFields( $_POST );
$isOk          = ! ( count( $invalidFields ) > 0 );

if ( $isOk && isProcessingForm() ) {
	$_POST['picture'] = uploadImage( $_FILES );

	if ( function_exists( 'connectPDO' ) ) {
		$contactCreated = createContactWithPDO( $_POST );
	} elseif ( function_exists( 'connectMySQLi' ) ) {
		$contactCreated = createContactWithMySQLi( $_POST );
	} else {
		$contactCreated = true;
	}

	if ( function_exists( 'endSession' ) ) {
		endSession();
	}
}

/** IMAGE */
function uploadImage( array $files ): ?string {
	try {
		$originalFileName = explode( ".", $files['profilePic']['name'] );
		$extension        = $originalFileName[ count( $originalFileName ) - 1 ];
		$guid             = getSomethingLikeGuid( true );
		$fileName         = "{$guid}.{$extension}";
        $uploadFolder     = "uploads";
		$path             = "uploads/{$fileName}";

		makeDirectoryIfNotExists($uploadFolder);

		move_uploaded_file( $files['profilePic']['tmp_name'], $path );

		if ( ! is_readable( $path ) ) {
			throw new Exception( "File created is not readable" );
		}

		if ( isWindowsServer() ) {
			exec( 'icacls "' . $path . '" /q /c /reset' );
		}

		return $path;
	} catch ( Exception $exception ) {
		var_dump( $exception->getMessage() );

		return null;
	}
}

function makeDirectoryIfNotExists(string $path): void {
    if (!is_dir($path)){
        mkdir($path, 0777, true);
    }
}

function isWindowsServer(): bool {
	if ( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'WIN' ) {
		return true;
	} else {
		return false;
	}
}

function getSomethingLikeGuid( bool $trim ): string {

	mt_srand( (int) microtime() * 10000 );
	$charid = strtolower( md5( uniqid( rand(), true ) ) );
	$hyphen = chr( 45 );                  // "-"
	$lbrace = $trim ? "" : chr( 123 );    // "{"
	$rbrace = $trim ? "" : chr( 125 );    // "}"
	$guidv4 = $lbrace .
	          substr( $charid, 0, 8 ) . $hyphen .
	          substr( $charid, 8, 4 ) . $hyphen .
	          substr( $charid, 12, 4 ) . $hyphen .
	          substr( $charid, 16, 4 ) . $hyphen .
	          substr( $charid, 20, 12 ) .
	          $rbrace;

	return $guidv4;
}

/** VALIDATION */

function getInvalidFields( $post ): array {

	$invalidFields = [];

	foreach ( $post as $key => $value ) {
		if ( ! isValid( $key, $value ) ) {
			$invalidFields[ $key ] = $value;
		}
	}

	return $invalidFields;
}

function isValid( string $fieldName, string $value ): bool {

	switch ( $fieldName ) {
		case ( 'name' ):
			return validateString( $value );
		case ( 'surname' ):
			return strlen( $value ) == 0 || validateString( $value );
		case ( 'email' ):
			return validateEmail( $value );
		case ( 'phone' ):
			return validateNumber( $value );
	}

	return true;
}

function validateString( $value ): bool {
	return strlen( $value ) > 0 && preg_match( "^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$^", $value );
}

function validateNumber( $value ): bool {
	return preg_match( '^[0-9]^', $value );
}

function validateEmail( $value ): bool {
	return filter_var( $value, FILTER_VALIDATE_EMAIL );
}

/** HELPERS */

function getValue( string $fieldName ): ?string {

	if ( array_key_exists( $fieldName, $_POST ) ) {
		return $_POST[ $fieldName ];
	}

	return null;
}

function alertIfInvalid( string $nameOfField, array $invalidFields ): ?string {

	if ( array_key_exists( $nameOfField, $invalidFields ) ) {
		return 'is-invalid';
	}

	return null;
}

function isProcessingForm(): bool {
	return $_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists( 'x-form', $_POST );
}

/** DATABASE */

/**
 * Create contact with PDO
 *
 * @param array $params
 *
 * @return bool
 */
function createContactWithPDO( array $params ): bool {

	$db = connectPDO( DB_HOST, DB_NAME, DB_USER, DB_PASS );

	if ( ! is_null( $db ) ) {

		$contactCreated = createContact( $db, $params );

		closeConnection( $db );

		return $contactCreated;
	}

	return false;
}

/**
 * Create contact with MySQLi
 *
 * @param array $params
 *
 * @return bool
 */
function createContactWithMySQLi( array $params ): bool {

	$db = connectMySQLi( DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME );

	if ( ! is_null( $db ) ) {

		$contactCreated = mysqliCreateContact( $db, $params );

		closeMySQLi( $db );

		return $contactCreated;
	}

	return false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        input[type=submit] {
            width: 100%;
        }

        .create-form {
            width: 500px;
        }

        .card-container {
            display: flex;
            justify-content: center;
        }

        .centered {
            text-align: center;
        }

        .bi-check-circle-fill {
            color: green;
            font-size: 10em;
        }

        .icon-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
<div class="container">
	<?php
	if ( isProcessingForm() && $isOk ): ?>

        <div class="card-container ">
            <div class="create-form card m-3">
                <div class="card-body">
                    <h5 class="card-title centered">Contatto inserito</h5>
                    <div class="icon-container">
                        <i class="bi bi-check-circle-fill centered"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="centered"><a href="<?= $_SERVER['PHP_SELF'] ?>">Inserisci un nuovo contatto</a></div>

	<?php else: ?>

        <div class="card-container ">
            <div class="create-form card m-3">
                <div class="card-body">

					<?php if ( ! $isOk ): ?>
                        <div class="alert alert-danger" role="alert">
                            Inserimento fallito!
                        </div>
					<?php endif; ?>

                    <h5 class="card-title">Aggiungi un contatto:</h5>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="x-form" value="contact">
                        <div class="mt-3 custom-file-button">
                            <input class="form-control" type="file" name="profilePic" id="profilePic" value="tt">
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control <?= alertIfInvalid( 'name', $invalidFields ) ?>"
                                   name="name"
                                   value="<?= getValue( 'name', $invalidFields ) ?>" id="name"
                                   oninput="removeInvalid(this)"
                                   placeholder="Mario" required>
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control <?= alertIfInvalid( 'surname', $invalidFields ) ?>"
                                   name="surname" value="<?= getValue( 'surname', $invalidFields ) ?>" id="surname"
                                   oninput="removeInvalid(this)" placeholder="Rossi">
                        </div>
                        <div class="mt-3">
                            <input type="text"
                                   class="form-control form-control <?= alertIfInvalid( 'phone', $invalidFields ) ?>"
                                   value="<?= getValue( 'phone', $invalidFields ) ?>" oninput="removeInvalid(this)"
                                   id="number"
                                   name="phone" placeholder="02 2021010" required>
                        </div>
                        <div class="mt-3">
                            <input type="text"
                                   class="form-control form-control <?= alertIfInvalid( 'email', $invalidFields ) ?>"
                                   value="<?= getValue( 'email', $invalidFields ) ?>" name="email"
                                   oninput="removeInvalid(this)"
                                   id="email" placeholder="Email" required>
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control <?= alertIfInvalid( 'company', $invalidFields ) ?>"
                                   value="<?= getValue( 'company', $invalidFields ) ?>" name="company" id="company"
                                   oninput="removeInvalid(this)" placeholder="Società">
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control <?= alertIfInvalid( 'role', $invalidFields ) ?>"
                                   value="<?= getValue( 'role', $invalidFields ) ?>" name="role" id="role"
                                   oninput="removeInvalid(this)" placeholder="Qualifica">
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control <?= alertIfInvalid( 'birthdate', $invalidFields ) ?>"
                                   value="<?= getValue( 'birthdate', $invalidFields ) ?>" name="birthdate"
                                   id="birthdate"
                                   oninput="removeInvalid(this)" placeholder="Data di Nascita">
                        </div>
                        <div class="mt-3 d-flex">
                            <input type="submit" class="btn btn-primary" value="Crea"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	<?php endif ?>
</div>
<script>

    function removeInvalid(elm) {
        elm.classList.remove('is-invalid');
    }

</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
</body>
</html>
