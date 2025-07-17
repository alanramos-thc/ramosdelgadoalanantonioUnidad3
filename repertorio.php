<?php
session_start();


if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo_usuario'])) {
    header("Location: iniciar_sesion.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];

require_once __DIR__ . '/models/cancion.php';
$cancion = new Cancion();
$canciones = $cancion->obtenerCanciones();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="assets/img/logo-ajetreados.png" rel="icon">
    <title>Ajetreados - Repertorio</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>
<style>
  body {
    background-image: url('assets/img/fondo-repertorio-ajetreados.jpg');
    background-size: cover;
    background-position: center;
  }
</style>
<body>

  <nav class="navbar">
    <div class="logo"><a href="inicio.php"><img src="assets/img/logo-ajetreados.png" alt="Ajetreados"></a><h2>Repertorio</h2></div>
        <div class="hamburguesa" id="hamburguesa">
        <i class="fas fa-bars" id="iconoMenu"></i>
    </div>
  </nav>

  <aside class="menu-lateral" id="menuLateral">
    <div class="cerrar" id="cerrarMenu"><i class="fas fa-times"></i></div>
    <ul>
      <li><a href="inicio.php">Inicio</a></li>
      <li><a href="repertorio.php" class="active">Repertorio</a></li>
      <li><a href="actions/cerrar-sesion.php">Salir</a></li>
    </ul>
  </aside>
  <div class="overlay" id="overlay"></div>


<div class="fondo-repertorio">


  <div class="buscar-agregar-cancion-repertorio animate__animated animate__fadeInDown animate__slower">
    <div class="buscador-repertorio animate__animated animate__fadeInLeft animate__slower">
      <input type="text" id="buscadorCancion" placeholder="Buscar canción por título...">
      <i class="fa fa-search"></i>
    </div>
    <?php if ($tipo_usuario === 'integrante'): ?>
    <div class="agregar-cancion-repertorio animate__animated animate__fadeInRight animate__slower">
      <button class="btn-agregar-cancion" data-bs-toggle="modal" data-bs-target="#modalAgregarCancion"> Agregar <i class="fa fa-plus"></i></button>
    </div>
    <?php endif; ?>
  </div>


    <table class="tabla-repertorio animate__animated animate__fadeInUp animate__slower">
        <thead>
            <tr>
                <th>Portada</th>
                <th>Título</th>
                <?php if ($tipo_usuario === 'integrante'): ?><th>Acciones</th><?php endif; ?>
            </tr>
        </thead>
        <tbody id="tablaCanciones">
        </tbody>
    </table>
</div>


<?php if ($tipo_usuario === 'integrante'): ?>
<div class="modal fade" id="modalAgregarCancion" tabindex="-1" aria-labelledby="modalAgregarCancionLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="formAgregarCancion" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar Canción</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="titulo">Título</label>
            <input type="text" name="titulo_cancion" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="portada">Portada</label>
            <input type="file" name="portada_cancion" accept="image/*" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="letra">Letra</label>
            <textarea name="letra_cancion" rows="6" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn-guardar">Guardar</button>
          <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>


<div class="modal fade" id="modalEditarCancion" tabindex="-1" aria-labelledby="modalEditarCancionLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="formEditarCancion" enctype="multipart/form-data">
      <input type="hidden" name="id_cancion" id="editarIdCancion">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Canción</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="editarTituloCancion">Título</label>
            <input type="text" name="titulo_cancion" id="editarTituloCancion" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="editarPortadaCancion">Portada</label>
            <input type="file" name="portada_cancion" id="editarPortadaCancion" accept="image/*" class="form-control">
            <div class="mt-2" id="previewPortada"></div>
          </div>
          <div class="mb-3">
            <label for="editarLetraCancion">Letra</label>
            <textarea name="letra_cancion" id="editarLetraCancion" rows="6" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn-guardar-cambios">Guardar Cambios</button>
          <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modalEliminarCancion" tabindex="-1" aria-labelledby="modalEliminarCancionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEliminarCancion">
      <input type="hidden" name="id_cancion" id="eliminarIdCancion">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar Eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro que deseas eliminar esta canción? Esta acción no se puede deshacer.
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn-eliminar">Eliminar</button>
          <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  window.tipoUsuarioAjetreados = '<?php echo $tipo_usuario; ?>';
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/app.js"></script>

</body>
</html>
