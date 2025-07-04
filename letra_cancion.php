<?php
session_start();

$integrante = $_SESSION['integrante'];

if (!isset($_SESSION['integrante'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

require_once __DIR__ . '/models/cancion.php';

if (!isset($_GET['id_cancion']) || !is_numeric($_GET['id_cancion'])) {
    echo "ID inválido";
    exit;
}

$cancion = new Cancion();
$cancion->id_cancion = $_GET['id_cancion'];
$datos = $cancion->obtenerPorId();

if (!$datos) {
    echo "Canción no encontrada";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="assets/img/logo-ajetreados.png" rel="icon">
    <title><?= htmlspecialchars($datos['titulo_cancion']) ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background:rgb(5, 5, 5);
            color: #333;
            animation: fadeIn 1s ease-in;
        }
    </style>
</head>
<body>

  <nav class="navbar">
    <div class="logo"><a href="inicio.php"><img src="assets/img/logo-ajetreados.png" alt="Ajetreados"></a></div>
        <div class="hamburguesa" id="hamburguesa">
        <i class="fas fa-bars" id="iconoMenu"></i>
    </div>
  </nav>

  <aside class="menu-lateral" id="menuLateral">
    <div class="cerrar" id="cerrarMenu"><i class="fas fa-times"></i></div>
    <ul>
      <li><a href="inicio.php">Inicio</a></li>
      <li><a href="repertorio.php">Repertorio</a></li>
      <li><a href="actions/cerrar-sesion.php">Salir</a></li>
    </ul>
  </aside>
  <div class="overlay" id="overlay"></div>

    <div class="contenedor-cancion">
        <div class="cabecera-cancion">
            <div class="portada-cancion">
                <img src="<?= $datos['portada_cancion'] ?>" alt="Portada de la canción">
            </div>
            <div class="titulo-cancion">
                <h1><?= htmlspecialchars($datos['titulo_cancion']) ?></h1>
            </div>
        </div>

        <pre><?= htmlspecialchars($datos['letra_cancion']) ?></pre>

        <a href="repertorio.php" class="btn-volver"><i class="fa fa-arrow-left"></i> Volver</a>
    </div>
<script src="assets/js/app.js"></script>
</body>
</html>


