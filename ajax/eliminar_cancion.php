<?php
require_once __DIR__ . '/../models/cancion.php';

if (!isset($_POST['id_cancion'])) {
    echo json_encode(['status' => 'error', 'mensaje' => 'ID no recibido']);
    exit;
}

$cancion = new Cancion();
$cancion->id_cancion = $_POST['id_cancion'];

if ($cancion->eliminarCancion()) {
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'No se pudo eliminar la canción']);
}
