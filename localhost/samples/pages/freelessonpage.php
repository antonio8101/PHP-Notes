<?php

$mark              = 18;
$examPassed        = false;
$examResultMessage = "";

switch ( $mark ) {
	case $mark >= 16 && $mark < 18:
		$examResultMessage = "L'esame non ha avuto esito incerto, si deve effettuare orale. Voto : " . $mark;
		break;
	case $mark >= 18 && $mark <= 30:
		$examPassed        = true;
		$examResultMessage = "L'esame ha avuto esito Positivo. Voto : " . $mark;
		break;
	case $mark > 30:
		$examPassed        = true;
		$examResultMessage = "L'esame ha avuto esito Molto Positivo. Voto : 30 e lode";
		break;
	default:
		$examResultMessage = "Esame non superato";
}

//$colors = array("red", "green", "blue", "purple"); # numerico
$colors = array(
        "color1" => "green",
        "color0" => "red",
        "color2" => "blue",
        "color3" => "purple"); # associativo

list($red, $green, $blue) = array("red", "green", "blue", "purple");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Free Lesson page</title>
</head>
<body>
<?= $red, " ", $green, " ", $blue ?>

<?php if ( $examPassed ): ?>
	<?php foreach ($colors as $key => $color): ?>

        <?php if ($color != "red") break ?>

        <p style="color: <?= $color ?>">
			<strong><?= $key ?>:</strong>
            <?= $examResultMessage ?>
        </p>

    <?php endforeach ?>
<?php else: ?>
    <p style="color: red"><?= $examResultMessage ?></p>
<?php endif ?>
</body>
</html>