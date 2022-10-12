<?php

require_once "inc/config.inc.php";
require_once "inc/helper.inc.php";
require_once "inc/mysqli/mysqli.php";
require_once "inc/mysqli/command.php";
require_once "inc/session.php";

require_once "templates.php";

require_once "inc/common.php";


$invalidFields  = getInvalidFields( $_POST );
$isOk           = ! ( count( $invalidFields ) > 0 );
$contactCreated = true;

if ( $isOk && isProcessingForm() ) {

    $pictureId = uploadImage( $_FILES );

    if (!is_null($pictureId)) {
	    $_POST['picture_id'] = $pictureId;
    }

	if ( function_exists( 'connectPDO' ) ) {
		$contactCreated = createContactWithPDO( $_POST );
	} elseif ( function_exists( 'connectMySQLi' ) ) {
		$contactCreated = createContactWithMySQLi( $_POST );
	}

	if ( function_exists( 'endSession' ) ) {
        endSession();
	}
}

/** IMAGE */

function uploadImage( array $files ): string|null {


	try {

		$file = $files['profilePic'];

		$db       = connectMySQLi( DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME );
		$imageDto = new ImageDto( $file['name'], $file['type'], $file['tmp_name'] );
		$service  = new ImageDbService( $db );

		return $service->set( $imageDto );

	} catch ( Exception $exception ) {

		addErrorToLog( $exception->getMessage() );

		return null;
	}
}

/** VALIDATION */

function getInvalidFields( $post ): array {

	$invalidFields = [];

	foreach ( $post as $key => $value ) {
		if ( ! isValid( $key, $value ) ) {
			$invalidFields[ $key ] = $value;
		}
	}

    if (count($invalidFields) > 0){
        addErrorToLog('There are some invalid fields...');
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

<?= getPageHeader(getPageTitle()) ?>

<?php if ( isProcessingForm() && $isOk && $contactCreated ): ?>

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
        <div class="centered"><a href="list.php">Lista contatti</a></div>

<?php else: ?>

        <div class="card-container ">
            <div class="create-form card m-3">
                <div class="card-body">

					<?php if ( ! $isOk || ! $contactCreated ): ?>
                        <div class="alert alert-danger" role="alert">
                            <p>Inserimento fallito!</p>
                            <p class="error-log"><?=getLog()?></p>
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
                                   value="<?= getValue( 'name', $_POST ) ?>" id="name"
                                   oninput="removeInvalid(this)"
                                   placeholder="Mario" required>
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control <?= alertIfInvalid( 'surname', $invalidFields ) ?>"
                                   name="surname" value="<?= getValue( 'surname', $_POST ) ?>" id="surname"
                                   oninput="removeInvalid(this)" placeholder="Rossi">
                        </div>
                        <div class="mt-3">
                            <input type="text"
                                   class="form-control form-control <?= alertIfInvalid( 'phone', $invalidFields ) ?>"
                                   value="<?= getValue( 'phone', $_POST ) ?>" oninput="removeInvalid(this)"
                                   id="number"
                                   name="phone" placeholder="02 2021010" required>
                        </div>
                        <div class="mt-3">
                            <input type="text"
                                   class="form-control form-control <?= alertIfInvalid( 'email', $invalidFields ) ?>"
                                   value="<?= getValue( 'email', $_POST ) ?>" name="email"
                                   oninput="removeInvalid(this)"
                                   id="email" placeholder="Email" required>
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control <?= alertIfInvalid( 'company', $invalidFields ) ?>"
                                   value="<?= getValue( 'company', $_POST ) ?>" name="company" id="company"
                                   oninput="removeInvalid(this)" placeholder="Società">
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control <?= alertIfInvalid( 'role', $invalidFields ) ?>"
                                   value="<?= getValue( 'role', $_POST ) ?>" name="role" id="role"
                                   oninput="removeInvalid(this)" placeholder="Qualifica">
                        </div>
                        <div class="mt-3">
                            <input type="text" class="form-control <?= alertIfInvalid( 'birthdate', $invalidFields ) ?>"
                                   value="<?= getValue( 'birthdate', $_POST ) ?>" name="birthdate"
                                   id="birthdate"
                                   oninput="removeInvalid(this)" placeholder="Data di Nascita">
                        </div>
                        <div class="form-buttons mt-3 d-flex">
                            <a href="list.php" class="btn btn-secondary m-1 flex-1">Cancel</a>
                            <input type="submit" class="btn btn-primary m-1 flex-1" value="Crea"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <script>
        function removeInvalid(elm) {
            elm.classList.remove('is-invalid');
        }
    </script>

<?php endif ?>

<?= getPageFooter() ?>



<?php unset($_SESSION['errors']);  ?>