<?php

# NULL COALESCING

$a = null;
$b = 1;

$x = $a ?? $b;

//var_dump( $x );

# Voti degli esami all'universita'
$mark = 17;
//
//if ( $mark >= 18 && $mark <= 30 ) {
//	echo "L'esame ha avuto esito Positivo. Voto : " . $mark;
//} elseif($mark >= 16 && $mark < 18){
//	echo "L'esame non ha avuto esito incerto, si deve effettuare orale. Voto : " . $mark;
//} elseif($mark > 30){
//	echo "L'esame ha avuto esito Molto Positivo. Voto : 30 e lode";
//}  else {
//	echo "Esame non superato";
//}


switch ($mark) {
	case $mark >= 16 && $mark < 18:
		echo "L'esame non ha avuto esito incerto, si deve effettuare orale. Voto : " . $mark;
		break;
	case $mark >= 22:
		echo "Something...";
		break;
	case $mark >= 18 && $mark <= 30:
		echo "L'esame ha avuto esito Positivo. Voto : " . $mark;
		break;
	case $mark > 30:
		echo "L'esame ha avuto esito Molto Positivo. Voto : 30 e lode";
		break;
	default:
		echo "Esame non superato";
}

