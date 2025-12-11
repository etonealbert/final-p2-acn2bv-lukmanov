<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'stranger_things_db');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conexion->set_charset('utf8mb4');
} catch (Exception $e) {
    die(json_encode([
        'exito' => false,
        'mensaje' => 'Error de conexión a la base de datos'
    ]));
}

