<?php
require_once __DIR__ . '/../models/cancion.php';

if (!isset($_POST['id_cancion'], $_POST['titulo_cancion'], $_POST['letra_cancion'])) {
    echo json_encode(['status' => 'error', 'mensaje' => 'Datos incompletos']);
    exit;
}

$cancion = new Cancion();
$cancion->id_cancion = $_POST['id_cancion'];
$cancion->titulo_cancion = $_POST['titulo_cancion'];
$cancion->letra_cancion = $_POST['letra_cancion'];

if (isset($_FILES['portada_cancion']) && $_FILES['portada_cancion']['error'] === 0) {
    $directorioUploads = '../uploads/';
    if (!is_dir($directorioUploads)) {
        mkdir($directorioUploads, 0755, true);
    }

    $nombreArchivo = uniqid() . '_' . basename($_FILES['portada_cancion']['name']);
    $rutaCompleta = $directorioUploads . $nombreArchivo;

    if (move_uploaded_file($_FILES['portada_cancion']['tmp_name'], $rutaCompleta)) {
        $cancion->portada_cancion = 'uploads/' . $nombreArchivo;
    } else {
        echo json_encode(['status' => 'error', 'mensaje' => 'Error al subir la portada']);
        exit;
    }
} else {
    $datos_actuales = $cancion->obtenerPorId();
    $cancion->portada_cancion = $datos_actuales['portada_cancion'] ?? '';
}

if ($cancion->actualizarCancion()) {
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'Error al actualizar en BD']);
}
