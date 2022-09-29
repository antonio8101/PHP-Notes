<?php

require_once "inc/config.inc.php";
require_once "inc/helper.inc.php";
require_once "inc/mysqli/mysqli.php";
require_once "inc/mysqli/query.php";

$db          = connectMySQLi( DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME );
$searchKey   = array_key_exists( 'search', $_GET ) ? $_GET['search'] : null;
$queryResult = searchContacts( $db, $searchKey );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= getPageTitle() ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="progress-container fixed-top">
    <span class="progress-bar"></span>
</div>
<div class="container">
    <div class="create-btn">
        <a href="create.php"><i class="bi bi-plus"></i></a>
    </div>
    <div class="card-container ">
        <div class="create-form card m-3">
            <div class="card-body">
                <h5 class="card-title">Lista contatti:</h5>
                <input class="form-control mb-2" type="text" id="searchText" oninput="processChange(this)"
                       placeholder="Write Name, Surname or Email...">
                <div class="list-group">
                    <!-- SINGLE CONTACT -->
                    <?php $counter = 0; ?>
                    <?php if ($queryResult): ?>
					<?php while ( $row = $queryResult->fetch_assoc() ): ?>
						<?php

						$nameInitial        = $row['name'][0];
						$surnameInitial     = substr( $row['surname'], 0, 1 );
						$placeHolderContent = $nameInitial . $surnameInitial;

						?>
                        <a href="#" class="d-flex list-group-item list-group-item-action" aria-current="true">
                            <div class="profile-pic me-2">
								<?php if ( ! is_null( $row['picture'] ) && strlen( $row['picture'] ) > 0 && file_exists( $row['picture'] ) ) : ?>
                                    <img src="<?= $row['picture'] ?>" alt="pic-image">
								<?php else: ?>
                                    <img src="https://via.placeholder.com/150/0000FF/808080?text=<?= $placeHolderContent ?>"
                                         alt="pic-image">
								<?php endif; ?>
                            </div>
                            <div>
                                <div class="w-100 mb-1">
                                    <h5 class="m-0"><?= $row['name'] ?> <?= $row['surname'] ?></h5>
                                </div>
                                <p class="m-0"><i class="bi bi-telephone"></i><?= $row['phone_number'] ?></p>
                                <small class="m-0 "><i class="bi bi-envelope"></i> <?= $row['email'] ?></small>
                            </div>
                        </a>
		                    <?php $counter++; ?>
					<?php endwhile; ?>
	                <?php endif; ?>

	                <?php if (!$queryResult || $counter === 0): ?>
                    <div class="d-flex list-group-item justify-content-center align-items-center">
                        No data
                    </div>
	                <?php endif; ?>

                    <!-- /SINGLE CONTACT -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
            crossorigin="anonymous"></script>
    <script>

        window.addEventListener('load', function () {
            const url = new URL(window.location.href);
            const searchParam = url.search.replace('?search=', '');

            if (searchParam.length > 0) {
                const elm = document.getElementById('searchText');

                if (searchParam.length > 0) {

                    elm.focus();
                    elm.value = searchParam;
                }
            }
        })

        function refreshList(elm) {
            location.href = location.origin + location.pathname + '?' + 'search=' + elm.value;
        }

        function debounce(func, timeout = 10) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        const processChange = debounce((elm) => refreshList(elm));
    </script>
</body>
</html>