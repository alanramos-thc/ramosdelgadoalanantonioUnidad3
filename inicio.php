<?php
session_start();

$integrante = $_SESSION['integrante'];

if (!isset($_SESSION['integrante'])) {
    header("Location: iniciar_sesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <link href="assets/img/logo-ajetreados.png" rel="icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ajetreados - Inicio</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

  <nav class="navbar">
    <div class="logo"><a href="inicio.php"><img src="assets/img/logo-ajetreados.png" alt="Ajetreados"></a><h2>Inicio</h2></div>
    <div class="hamburguesa" id="hamburguesa">
      <i class="fas fa-bars" id="iconoMenu"></i>
    </div>
  </nav>

  <aside class="menu-lateral" id="menuLateral">
    <div class="cerrar" id="cerrarMenu"><i class="fas fa-times"></i></div>
    <ul>
      <li><a href="inicio.php" class="active">Inicio</a></li>
      <li><a href="repertorio.php">Repertorio</a></li>
      <li><a href="actions/cerrar-sesion.php">Salir</a></li>
    </ul>
  </aside>
  <div class="overlay" id="overlay"></div>

  <section class="seccion-video">
    <video src="assets/video/banner-video.mp4" autoplay loop muted></video>
  </section>

  <div class="seccion-integrantes">
      <div class="floating-notes">
        <div class="note">♪</div>
        <div class="note">♫</div>
        <div class="note">♪</div>
        <div class="note">♬</div>
        <div class="note">♫</div>
        <div class="note">♪</div>
    </div>
    
    <div class="container">
        <div class="band-title">
            <h1>Ajetreados</h1>
            <p>Banda Local de Saltillo</p>
        </div>
        
        <div class="members-grid">
            <div class="member-card">
                <div class="member-avatar">
                    <img src="assets/img/jonathan.jpg" alt="Jonathan">
                </div>
                <h3 class="member-name">Jonathan</h3>
                <p class="member-instrument">Vocalista</p>
            </div>
            
            <div class="member-card">
                <div class="member-avatar">
                    <img src="assets/img/emmanuel.jpg" alt="Emmanuel">
                </div>
                <h3 class="member-name">Emmanuel</h3>
                <p class="member-instrument">Guitarrista</p>
            </div>
            
            <div class="member-card">
                <div class="member-avatar">
                    <img src="assets/img/juan.jpg" alt="Juan">
                </div>
                <h3 class="member-name">Juan</h3>
                <p class="member-instrument">Requintista</p>
            </div>
            
            <div class="member-card">
                <div class="member-avatar">
                    <img src="assets/img/alexis.jpg" alt="Alexis">
                </div>
                <h3 class="member-name">Alexis</h3>
                <p class="member-instrument">Tololochista</p>
            </div>
            
            <div class="member-card">
                <div class="member-avatar">
                    <img src="assets/img/enrique.jpg" alt="Enrique">
                </div>
                <h3 class="member-name">Enrique</h3>
                <p class="member-instrument">Trombónista</p>
            </div>
        </div>
    </div>
    </div>

  <footer>
    <p>&copy; 2025 Ajetreados | Todos los derechos reservados</p>
    <div class="social-icons">
      <a href="https://www.facebook.com/share/16zEbjAFXw/" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/ajetreados_?igsh=YTE1cXh4dWxvejFy" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.tiktok.com/@ajetreados_?_t=ZS-8xjVvFGeamu&_r=1" target="_blank"><i class="fab fa-tiktok"></i></a>
      <a href="https://wa.me/528442867567" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>
    <div>
      <a href="inicio.php">Inicio</a> | <a href="repertorio.php">Repertorio</a> | <a href="actions/cerrar-sesion.php">Salir</a>
    </div>
  </footer>

  <script src="assets/js/app.js"></script>
</body>
</html>
