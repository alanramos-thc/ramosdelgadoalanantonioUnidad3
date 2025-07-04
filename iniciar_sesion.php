<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <link href="assets/img/logo-ajetreados.png" rel="icon">
  <title>Ajetreados - Iniciar Sesión</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body class="fondo-iniciar-sesion">
  <div class="contenedor-iniciar-sesion animate__animated animate__fadeIn">
    <div class="titulo-iniciar-sesion">
      <h2>Iniciar Sesión</h2>
    </div>
    <div class="formulario-iniciar-sesion">
      <form action="actions/procesar-inicio-de-sesion.php" method="POST">
        <label for="numero_telefono_integrante">Número de teléfono:</label>
        <div class="iconos-formulario-iniciar-sesion">
          <i class="fas fa-phone"></i>
          <input type="text" id="numero_telefono_integrante" name="numero_telefono_integrante"
                 pattern="^\d{10}$" title="El número de teléfono debe tener exactamente 10 dígitos." required />
        </div>

        <label for="contrasena_integrante">Contraseña:</label>
        <div class="iconos-formulario-iniciar-sesion">
          <i class="fas fa-lock"></i>
          <input type="password" id="contrasena_integrante" name="contrasena_integrante" required />
        </div>

        <input type="submit" value="Ingresar" />
      </form>
      
        <?php
            if (isset($_SESSION['errorIniciarSesion'])) {
                echo '<p class="error-mensaje-iniciar-sesion">' . $_SESSION['errorIniciarSesion'] . '</p>';
                unset($_SESSION['errorIniciarSesion']);
            }
        ?>
    </div>
  </div>
</body>
</html>
