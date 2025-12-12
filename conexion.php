<?php
error_reporting(0);
ini_set('display_errors', 0);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'stranger_things_db');

mysqli_report(MYSQLI_REPORT_OFF);

$conexion = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion->connect_error) {
    $conexion = null;
} else {
    $conexion->set_charset('utf8mb4');
}

