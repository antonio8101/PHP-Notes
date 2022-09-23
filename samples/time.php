<?php

echo $_SERVER['REQUEST_TIME'] . PHP_EOL;
echo time() . PHP_EOL;
echo var_dump(strtotime('1660510533'));
echo var_dump(strtotime('2022-01-01'));
echo var_dump(strtotime('2022-12-01 23:58'));
echo date("Y-m-d H:i:s", strtotime('2022-12-01 23:58'));
//var_dump(getdate());
echo PHP_EOL;
echo date("Y-m-d H:i:s", mktime(23, 0, 0, 1));

$d = new DateTimeImmutable();
echo PHP_EOL;
echo $d->format( DateTimeInterface::W3C);

$d1 = $d->setDate(2021, 12, 1);

echo PHP_EOL;
echo $d->format( DateTimeInterface::W3C);
echo PHP_EOL;
echo $d1->format( DateTimeInterface::W3C);