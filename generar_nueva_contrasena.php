<?php
require_once __DIR__ . '/config/db.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$token = $_GET['token'] ?? '';
if (!$token) {
    header("Location: iniciar_sesion.php");
    exit;
}

$db = new Db();
$pdo = $db->getConnection();

$id = null;
$tabla = null;
$campoId = null;
$campoToken = null;

$sqlIntegrante = "SELECT id_integrante, token_integrante FROM integrantes WHERE token_integrante IS NOT NULL";
$stmtIntegrante = $pdo->prepare($sqlIntegrante);
$stmtIntegrante->execute();
while ($row = $stmtIntegrante->fetch(PDO::FETCH_ASSOC)) {
    if (password_verify($token, $row['token_integrante'])) {
        $id = $row['id_integrante'];
        $tabla = 'integrantes';
        $campoId = 'id_integrante';
        $campoToken = 'token_integrante';
        break;
    }
}

if (!$id) {
    $sqlInvitado = "SELECT id_invitado, token_invitado FROM invitados WHERE token_invitado IS NOT NULL";
    $stmtInvitado = $pdo->prepare($sqlInvitado);
    $stmtInvitado->execute();
    while ($row = $stmtInvitado->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($token, $row['token_invitado'])) {
            $id = $row['id_invitado'];
            $tabla = 'invitados';
            $campoId = 'id_invitado';
            $campoToken = 'token_invitado';
            break;
        }
    }
}

if (!$id || !$tabla) {
    header("Location: iniciar_sesion.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <link href="assets/img/logo-ajetreados.png" rel="icon">
  <title>Generar Nueva Contraseña - Ajetreados</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body class="fondo-recuperar-contrasena">
  <div class="contenedor-recuperar-contrasena animate__animated animate__fadeIn">
    <div class="titulo-recuperar-contrasena">
      <h2>Generar Nueva Contraseña</h2>
    </div>
    <div class="formulario-recuperar-contrasena">
      <form action="actions/generar-nueva-contrasena.php" method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <label for="nueva_contrasena">Nueva Contraseña:</label>
        <div class="iconos-formulario-recuperar-contrasena">
          <i class="fas fa-lock"></i>
          <input type="password" id="nueva_contrasena" name="nueva_contrasena" required />
        </div>
        <label for="confirmar_nueva_contrasena">Confirmar Nueva Contraseña:</label>
        <div class="iconos-formulario-recuperar-contrasena">
          <i class="fas fa-lock"></i>
          <input type="password" id="confirmar_nueva_contrasena" name="confirmar_nueva_contrasena" required />
        </div>
        <input type="submit" value="Guardar" />
        <div id="error-password-match" class="mensaje-error" style="display:none;"></div>
      </form>
    </div>
  </div>
</body>
</html>
<script src="assets/js/app.js"></script>