document.addEventListener("DOMContentLoaded", function () {
  const hamburguesa = document.getElementById('hamburguesa');
  const menu = document.getElementById('menuLateral');
  const icono = document.getElementById('iconoMenu');
  const overlay = document.getElementById('overlay');

  function toggleMenu() {
    const abierto = menu.classList.toggle('abierto');
    overlay.classList.toggle('activo');

    icono.classList.add('animar');
    setTimeout(() => {
      if (abierto) {
        icono.classList.remove('fa-bars');
        icono.classList.add('fa-times');
      } else {
        icono.classList.remove('fa-times');
        icono.classList.add('fa-bars');
      }
      icono.classList.remove('animar');
    }, 150);
  }

  hamburguesa.addEventListener('click', toggleMenu);

  overlay.addEventListener('click', toggleMenu);

  (function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'959a704932a616d1',t:'MTc1MTU4ODIzNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();
});

$(document).ready(function () {
    recargarTabla();
    
    function recargarTabla() {
        $.ajax({
            url: 'ajax/tabla_canciones.php',
            method: 'GET',
            success: function (data) {
                $('#tablaCanciones').html(data);
                asignarEventos();
            },
            error: function () {
                alert('Error al recargar la tabla.');
            }
        });
    }

    function asignarEventos() {
        $('.btnEditarCancion').on('click', function () {
            const idCancion = $(this).data('idCancion');

            $.ajax({
                url: 'ajax/obtener_cancion.php',
                method: 'POST',
                data: { id_cancion: idCancion },
                success: function (resp) {
                    let res = JSON.parse(resp);
                    if (res.status === 'ok') {
                        let data = res.data;
                        $('#editarIdCancion').val(data.id_cancion);
                        $('#editarTituloCancion').val(data.titulo_cancion);
                        $('#editarLetraCancion').val(data.letra_cancion);
                        $('#previewPortadaCancion').html('<img src="' + data.portada_cancion + '" width="100" height="100"');
                        $('#modalEditarCancion').modal('show');
                    } else {
                        alert('Error: ' + res.mensaje);
                    }
                },
                error: function () {
                    alert('Error de conexión al cargar canción');
                }
            });
        });

        $('.btnEliminarCancion').on('click', function () {
            const idCancion = $(this).data('idCancion');
            $('#eliminarIdCancion').val(idCancion);
            $('#modalEliminarCancion').modal('show');
        });
    }

    $('#formAgregarCancion').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: 'ajax/agregar_cancion.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (resp) {
                let res = JSON.parse(resp);

                if (res.status === 'ok') {
                    toastr.success("Canción agregada correctamente");
                    $('#modalAgregarCancion').modal('hide');
                    recargarTabla();
                } else {
                    alert("Error: " + res.mensaje);
                }
            },
            error: function () {
                alert("Error de conexión con el servidor.");
            }
        });
    });


    $('.btn-editar-cancion').on('click', function () {
        let idCancion = $(this).closest('tr').find('td:first img').attr('data-id-cancion') || $(this).closest('tr').find('td').eq(1).data('id');

        idCancion = $(this).data('idCancion');

        if (!idCancion) {
            alert('Error al obtener el ID');
            return;
        }

        $.ajax({
            url: 'ajax/obtener_cancion.php',
            method: 'POST',
            data: { id_cancion: idCancion },
            success: function (resp) {
                let res = JSON.parse(resp);
                if (res.status === 'ok') {
                    let data = res.data;
                    $('#editarIdCancion').val(data.id_cancion);
                    $('#editarTituloCancion').val(data.titulo_cancion);
                    $('#editarLetraCancion').val(data.letra_cancion);
                    $('#previewPortadaCancion').html('<img src="' + data.portada_cancion + '" width="100" heigth="100" alt="portada">');
                    $('#modalEditarCancion').modal('show');
                } else {
                    alert('Error: ' + res.mensaje);
                }
            },
            error: function () {
                alert('Error de conexión al cargar canción');
            }
        });
    });

    $('#formEditarCancion').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: 'ajax/editar_cancion.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (resp) {
                let res = JSON.parse(resp);
                if (res.status === 'ok') {
                    toastr.success('Canción actualizada');
                    $('#modalEditarCancion').modal('hide');
                    recargarTabla();
                } else {
                    alert('Error: ' + res.mensaje);
                }
            },
            error: function () {
                alert('Error de conexión al actualizar canción');
            }
        });
    });

    $('.btnEliminarCancion').on('click', function () {
        const idCancion = $(this).data('idCancion');
        $('#eliminarIdCancion').val(idCancion);
        $('#modalEliminarCancion').modal('show');
    });

    $('#formEliminarCancion').on('submit', function (e) {
        e.preventDefault();

        const idCancion = $('#eliminarIdCancion').val();

        $.ajax({
            url: 'ajax/eliminar_cancion.php',
            type: 'POST',
            data: { id_cancion: idCancion },
            success: function (resp) {
                let res = JSON.parse(resp);
                if (res.status === 'ok') {
                    toastr.success('Canción eliminada');
                    $('#modalEliminarCancion').modal('hide');
                    recargarTabla();
                } else {
                    alert('Error: ' + res.mensaje);
                }
            },
            error: function () {
                alert('Error de conexión con el servidor');
            }
        });
    });

    $('#buscadorCancion').on('input', function () {
        let query = $(this).val();

        $.ajax({
            url: 'ajax/tabla_canciones.php',
            method: 'GET',
            data: { q: query },
            success: function (data) {
                $('#tablaCanciones').html(data);
                asignarEventos(); 
            },
            error: function () {
                alert('Error al buscar');
            }
        });
    });
});

