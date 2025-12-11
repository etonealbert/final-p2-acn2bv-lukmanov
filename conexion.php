<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'stranger_things_db');

$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion->connect_error) {
    die(json_encode([
        'exito' => false,
        'mensaje' => 'Error de conexión: ' . $conexion->connect_error
    ]));
}

$conexion->set_charset('utf8mb4');

