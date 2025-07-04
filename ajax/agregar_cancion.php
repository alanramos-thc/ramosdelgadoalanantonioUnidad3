<?php
require_once __DIR__ . '/../models/cancion.php';

$cancion = new Cancion();

$tituloCancion = $_POST['titulo_cancion'] ?? '';
$letraCancion = $_POST['letra_cancion'] ?? '';
$portadaCancionPath = '';

if (isset($_FILES['portada_cancion']) && $_FILES['portada_cancion']['error'] === 0) {
    $directorioUploads = '../uploads/';
    if (!is_dir($directorioUploads)) {
        mkdir($directorioUploads, 0755, true);
    }

    $nombreArchivo = uniqid() . '_' . basename($_FILES['portada_cancion']['name']);
    $rutaCompleta = $directorioUploads . $nombreArchivo;

    if (move_uploaded_file($_FILES['portada_cancion']['tmp_name'], $rutaCompleta)) {
        $portadaCancionPath = 'uploads/' . $nombreArchivo;
    } else {
        echo json_encode(['status' => 'error', 'mensaje' => 'Error al subir la portada']);
        exit;
    }
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'Portada no enviada']);
    exit;
}

$cancion->titulo_cancion = $tituloCancion;
$cancion->portada_cancion = $portadaCancionPath;
$cancion->letra_cancion = $letraCancion;

if ($cancion->agregarCancion()) {
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'No se pudo guardar en la base de datos']);
}
?>
