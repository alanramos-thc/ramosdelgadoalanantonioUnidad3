<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <link href="assets/img/logo-ajetreados.png" rel="icon">
  <title>Recuperar Contraseña - Ajetreados</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body class="fondo-recuperar-contrasena">
  <div class="contenedor-recuperar-contrasena animate__animated animate__fadeIn">
    <div class="titulo-recuperar-contrasena">
      <h2>Recuperar <br> Contraseña</h2>
    </div>
    <div class="formulario-recuperar-contrasena">
      <form action="actions/procesar-recuperacion-de-contrasena.php" method="POST">
        <label for="correo_electronico">Correo electrónico:</label>
        <div class="iconos-formulario-recuperar-contrasena">
          <i class="fas fa-envelope"></i>
          <input type="email" id="correo_electronico" name="correo_electronico" required />
        </div>
        <input type="submit" value="Enviar" />
      </form>
      <div class="contenedor-link-recuperar-contrasena">
        <a href="iniciar_sesion.php">Volver al inicio de sesión</a>
      </div>
      <?php
        if (isset($_SESSION['mensajeRecuperarContrasena'])) {
            echo '<p class="mensaje-recuperar-contrasena">' . $_SESSION['mensajeRecuperarContrasena'] . '</p>';
            unset($_SESSION['mensajeRecuperarContrasena']);
        }
      ?>
    </div>
  </div>
</body>
</html>
