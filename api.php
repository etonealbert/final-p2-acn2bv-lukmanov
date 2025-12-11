<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'conexion.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$accion = isset($_GET['accion']) ? $_GET['accion'] : (isset($_POST['accion']) ? $_POST['accion'] : '');

function responder($exito, $mensaje, $datos = null) {
    echo json_encode([
        'exito' => $exito,
        'mensaje' => $mensaje,
        'datos' => $datos
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

switch ($accion) {
    case 'listar':
        listarPersonajes($conexion);
        break;
    
    case 'obtener':
        obtenerPersonaje($conexion);
        break;
    
    case 'crear':
        crearPersonaje($conexion);
        break;
    
    case 'actualizar':
        actualizarPersonaje($conexion);
        break;
    
    case 'eliminar':
        eliminarPersonaje($conexion);
        break;
    
    default:
        responder(false, 'Acción no válida');
}

function listarPersonajes($conexion) {
    $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
    $rol = isset($_GET['rol']) ? trim($_GET['rol']) : '';
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 5;
    
    $offset = ($pagina - 1) * $por_pagina;
    
    $sql = "SELECT * FROM personajes WHERE 1=1";
    
    if (!empty($busqueda)) {
        $busqueda_segura = $conexion->real_escape_string($busqueda);
        $sql .= " AND nombre LIKE '%$busqueda_segura%'";
    }
    
    if (!empty($rol) && $rol !== 'Todos') {
        $rol_seguro = $conexion->real_escape_string($rol);
        $sql .= " AND rol = '$rol_seguro'";
    }
    
    $sql_total = str_replace('SELECT *', 'SELECT COUNT(*) as total', $sql);
    $resultado_total = $conexion->query($sql_total);
    $total = $resultado_total->fetch_assoc()['total'];
    
    $sql .= " ORDER BY id DESC LIMIT $por_pagina OFFSET $offset";
    
    $resultado = $conexion->query($sql);
    
    if (!$resultado) {
        responder(false, 'Error al obtener personajes: ' . $conexion->error);
    }
    
    $personajes = [];
    while ($fila = $resultado->fetch_assoc()) {
        $personajes[] = $fila;
    }
    
    responder(true, 'Personajes obtenidos', [
        'personajes' => $personajes,
        'total' => $total,
        'pagina' => $pagina,
        'total_paginas' => ceil($total / $por_pagina)
    ]);
}

function obtenerPersonaje($conexion) {
    if (!isset($_GET['id'])) {
        responder(false, 'ID no proporcionado');
    }
    
    $id = (int)$_GET['id'];
    
    $sql = "SELECT * FROM personajes WHERE id = $id";
    $resultado = $conexion->query($sql);
    
    if (!$resultado) {
        responder(false, 'Error al obtener personaje: ' . $conexion->error);
    }
    
    if ($resultado->num_rows === 0) {
        responder(false, 'Personaje no encontrado');
    }
    
    $personaje = $resultado->fetch_assoc();
    responder(true, 'Personaje obtenido', $personaje);
}

function crearPersonaje($conexion) {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $rol = isset($_POST['rol']) ? trim($_POST['rol']) : '';
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
    $temporada = isset($_POST['temporada']) ? (int)$_POST['temporada'] : 0;
    $imagen_url = isset($_POST['imagen_url']) ? trim($_POST['imagen_url']) : '';
    
    if (empty($nombre)) {
        responder(false, 'El nombre es obligatorio');
    }
    
    if (empty($rol)) {
        responder(false, 'El rol es obligatorio');
    }
    
    if (empty($descripcion)) {
        responder(false, 'La descripción es obligatoria');
    }
    
    if ($temporada < 1 || $temporada > 5) {
        responder(false, 'La temporada debe estar entre 1 y 5');
    }
    
    $nombre_seguro = $conexion->real_escape_string($nombre);
    $rol_seguro = $conexion->real_escape_string($rol);
    $descripcion_segura = $conexion->real_escape_string($descripcion);
    $imagen_url_segura = $conexion->real_escape_string($imagen_url);
    
    $sql = "INSERT INTO personajes (nombre, rol, descripcion, temporada, imagen_url) 
            VALUES ('$nombre_seguro', '$rol_seguro', '$descripcion_segura', $temporada, '$imagen_url_segura')";
    
    if ($conexion->query($sql)) {
        $nuevo_id = $conexion->insert_id;
        responder(true, 'Personaje creado exitosamente', ['id' => $nuevo_id]);
    } else {
        responder(false, 'Error al crear personaje: ' . $conexion->error);
    }
}

function actualizarPersonaje($conexion) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $rol = isset($_POST['rol']) ? trim($_POST['rol']) : '';
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
    $temporada = isset($_POST['temporada']) ? (int)$_POST['temporada'] : 0;
    $imagen_url = isset($_POST['imagen_url']) ? trim($_POST['imagen_url']) : '';
    
    if ($id < 1) {
        responder(false, 'ID no válido');
    }
    
    if (empty($nombre)) {
        responder(false, 'El nombre es obligatorio');
    }
    
    if (empty($rol)) {
        responder(false, 'El rol es obligatorio');
    }
    
    if (empty($descripcion)) {
        responder(false, 'La descripción es obligatoria');
    }
    
    if ($temporada < 1 || $temporada > 5) {
        responder(false, 'La temporada debe estar entre 1 y 5');
    }
    
    $nombre_seguro = $conexion->real_escape_string($nombre);
    $rol_seguro = $conexion->real_escape_string($rol);
    $descripcion_segura = $conexion->real_escape_string($descripcion);
    $imagen_url_segura = $conexion->real_escape_string($imagen_url);
    
    $sql = "UPDATE personajes SET 
            nombre = '$nombre_seguro',
            rol = '$rol_seguro',
            descripcion = '$descripcion_segura',
            temporada = $temporada,
            imagen_url = '$imagen_url_segura'
            WHERE id = $id";
    
    if ($conexion->query($sql)) {
        responder(true, 'Personaje actualizado exitosamente');
    } else {
        responder(false, 'Error al actualizar personaje: ' . $conexion->error);
    }
}

function eliminarPersonaje($conexion) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : (isset($_GET['id']) ? (int)$_GET['id'] : 0);
    
    if ($id < 1) {
        responder(false, 'ID no válido');
    }
    
    $sql = "DELETE FROM personajes WHERE id = $id";
    
    if ($conexion->query($sql)) {
        responder(true, 'Personaje eliminado exitosamente');
    } else {
        responder(false, 'Error al eliminar personaje: ' . $conexion->error);
    }
}

