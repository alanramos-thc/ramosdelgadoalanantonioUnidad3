<?php
require_once __DIR__ . '/../models/cancion.php';

$cancion = new Cancion();

$busqueda = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($busqueda !== '') {
    $canciones = $cancion->buscarPorTitulo($busqueda);
} else {
    $canciones = $cancion->obtenerCanciones();
}

foreach ($canciones as $c): ?>
<tr>
    <td><img src="<?= $c['portada_cancion'] ?>" alt="portada" width="100"></td>
    <td><a href="letra_cancion.php?id_cancion=<?= $c['id_cancion'] ?>"><?= htmlspecialchars($c['titulo_cancion']) ?></a></td>
    <td>
        <button class="btn-editar-cancion btnEditarCancion" data-id-cancion="<?= $c['id_cancion'] ?>"><i class="fa fa-pencil"></i></button>
        <button class="btn-eliminar-cancion btnEliminarCancion" data-id-cancion="<?= $c['id_cancion'] ?>"><i class="fa fa-trash"></i></button>
    </td>
</tr>
<?php endforeach;