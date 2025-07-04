<?php
session_start();
require_once __DIR__ . '/../models/integrante.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero_telefono_integrante = trim($_POST['numero_telefono_integrante'] ?? '');
    $contrasena_integrante = trim($_POST['contrasena_integrante'] ?? '');

    if (!preg_match('/^\d+$/', $numero_telefono_integrante) || empty($contrasena_integrante)) {
        echo "Número de teléfono o contraseña inválidos.";
        exit;
    }

    $integrante = new Integrante();
    $integrante->numero_telefono_integrante = $numero_telefono_integrante;
    $integrante->contrasena_integrante = $contrasena_integrante;

    $datosIntegrante = $integrante->IniciarSesion();

    if ($datosIntegrante) {
        $_SESSION['integrante'] = $datosIntegrante;
        header("Location: ../inicio.php");
        exit;
    } else {
        $_SESSION['errorIniciarSesion'] = "Teléfono o contraseña incorrectos.";
        header("Location: ../iniciar_sesion.php");
    }
} else {
    $_SESSION['errorIniciarSesion'] = "Método no permitido.";
    header("Location: ../iniciar_sesion.php");
}
