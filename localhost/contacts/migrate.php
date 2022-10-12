<?php

require_once 'inc/config.inc.php';
require_once 'inc/mysqli/mysqli.php';
require_once 'services/ImageService.php';

$db = connectMySQLi( DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME );

echo "migrating table for pictures......";

ImageDbService::CreateImageTable($db, 'contacts');

echo "done";