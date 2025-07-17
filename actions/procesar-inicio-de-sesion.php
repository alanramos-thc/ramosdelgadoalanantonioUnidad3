<?php
session_start();
require_once __DIR__ . '/../models/integrante.php';
require_once __DIR__ . '/../models/invitado.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero_telefono = trim($_POST['numero_telefono'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');

    if (!preg_match('/^\d{10}$/', $numero_telefono) || empty($contrasena)) {
        $_SESSION['errorIniciarSesion'] = "Número de teléfono o contraseña inválidos.";
        header("Location: ../iniciar_sesion.php");
        exit;
    }

    $integrante = new Integrante();
    $integrante->numero_telefono_integrante = $numero_telefono;
    $integrante->contrasena_integrante = $contrasena;
    $datosIntegrante = $integrante->IniciarSesion();

    if ($datosIntegrante) {
        $_SESSION['usuario'] = $datosIntegrante;
        $_SESSION['tipo_usuario'] = 'integrante';
        header("Location: ../inicio.php");
        exit;
    }

    $invitado = new Invitado();
    $invitado->numero_telefono_invitado = $numero_telefono;
    $invitado->contrasena_invitado = $contrasena;
    $datosInvitado = $invitado->IniciarSesion();

    if ($datosInvitado) {
        $_SESSION['usuario'] = $datosInvitado;
        $_SESSION['tipo_usuario'] = 'invitado';
        header("Location: ../inicio.php");
        exit;
    }

    $_SESSION['errorIniciarSesion'] = "Teléfono o contraseña incorrectos.";
    header("Location: ../iniciar_sesion.php");
    exit;
} else {
    $_SESSION['errorIniciarSesion'] = "Método no permitido.";
    header("Location: ../iniciar_sesion.php");
}
