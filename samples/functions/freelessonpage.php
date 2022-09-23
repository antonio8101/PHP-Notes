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

for ($i = 10; $i >= 0; $i --){
	echo "decrement " . $i . "<br>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Free Lesson page</title>
</head>
<body>
<?php if ( $examPassed ): ?>
    <p style="color: green">
	    <?php for ($i = 0; $i <= 10; $i ++): ?>
            .&nbsp;
	    <?php endfor ?>
		<?= $examResultMessage ?>
    </p>
<?php else: ?>
    <p style="color: red"><?= $examResultMessage ?></p>
<?php endif ?>
</body>
</html>