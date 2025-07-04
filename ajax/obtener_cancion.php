<?php
require_once __DIR__ . '/../models/cancion.php';

if (!isset($_POST['id_cancion'])) {
    echo json_encode(['status' => 'error', 'mensaje' => 'ID no recibido']);
    exit;
}

$cancion = new Cancion();
$cancion->id_cancion = $_POST['id_cancion'];

$datos = $cancion->obtenerPorId();

if ($datos) {
    echo json_encode(['status' => 'ok', 'data' => $datos]);
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'Canción no encontrada']);
}
