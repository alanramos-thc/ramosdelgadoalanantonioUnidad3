<?php
session_start();

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generarTokenUsuario($longitudTokenUsuario = 32) {
    return bin2hex(random_bytes($longitudTokenUsuario));
}

$tokenGenerado = generarTokenUsuario();
$tokenHasheado = password_hash($tokenGenerado, PASSWORD_DEFAULT);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo_electronico'] ?? '';
    $db = new Db();
    $pdo = $db->getConnection();
 
    $sqlIntegrante = "SELECT * FROM integrantes WHERE correo_electronico_integrante = :correo";
    $stmtIntegrante = $pdo->prepare($sqlIntegrante);
    $stmtIntegrante->bindParam(':correo', $correo, PDO::PARAM_STR);
    $stmtIntegrante->execute();
    $integrante = $stmtIntegrante->fetch(PDO::FETCH_ASSOC);

    $invitado = null;
    if (!$integrante) {
        $sqlInvitado = "SELECT * FROM invitados WHERE correo_electronico_invitado = :correo";
        $stmtInvitado = $pdo->prepare($sqlInvitado);
        $stmtInvitado->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmtInvitado->execute();
        $invitado = $stmtInvitado->fetch(PDO::FETCH_ASSOC);
    }

    if ($integrante || $invitado) {
        if ($integrante) {
            $nombre = $integrante['nombre_integrante'] ?? '';
            $sqlUpdate = "UPDATE integrantes SET token_integrante = :token WHERE correo_electronico_integrante = :correo";
        } else {
            $nombre = $invitado['nombre_invitado'] ?? '';
            $sqlUpdate = "UPDATE invitados SET token_invitado = :token WHERE correo_electronico_invitado = :correo";
        }
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':token', $tokenHasheado, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmtUpdate->execute();

        if ($stmtUpdate->rowCount() > 0) {
            $servidorSMTP = 'smtp.gmail.com';
            $puertoSMTP = 587;
            $usuarioSMTP = 'alanradax@gmail.com';
            $claveSMTP = 'tkvoadvqeiguugna';

            $correoRemitente = $usuarioSMTP;
            $correoDestinatario = $correo;
            $asuntoCorreo = 'Recupera el acceso a tu cuenta en Ajetreados';

            $cuerpoCorreo = '
            <div style="width: 450px; background-color: white; margin: 0 auto;">
                <div style="display: flex; justify-content: space-between; align-items: center; background-color: #5100bb; padding: 20px;">
                    <h1 style="color: white; font-family: Roboto, sans-serif; font-weight: 800; font-size: 18px; text-align: center; flex: 1;">¡Recupera el Acceso a tu Cuenta en Ajetreados!</h1>
                    <div style="background-color: white; border-radius: 19px; width: 90px; height: 85px; display: flex; align-items: center; justify-content: center;">
                        <img src="https://cdn-icons-png.flaticon.com/512/6357/6357048.png" loading="lazy" alt="Ajetreados" style="width: auto; height: 70px; margin-top: 8px; margin-left: 4px;">
                    </div>
                </div>
                <div style="font-size: 16px; font-family: DM Sans, sans-serif; color: #020132; padding: 20px;">
                    <p>Hola ' . htmlspecialchars($nombre) . ',</p>
                    <p>Recibimos una solicitud para restablecer tu contraseña en Ajetreados.</p>
                    <p>Haz clic en el siguiente enlace para crear una nueva contraseña:</p>
                    <p><a style="color: #5100bb;" href="http://localhost/ajetreados/generar_nueva_contrasena.php?token=' . urlencode($tokenGenerado) . '">Generar Nueva Contraseña</a></p>
                    <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
                    <p>¡Gracias!<br>El grupo de Ajetreados</p>
                </div>
                <div style="width: 100%; height: 25px; background-color: #5100bb;"></div>
            </div>
            ';

            $correoObj = new PHPMailer(true);
            try {
                $correoObj->isSMTP();
                $correoObj->Host = $servidorSMTP;
                $correoObj->SMTPAuth = true;
                $correoObj->Username = $usuarioSMTP;
                $correoObj->Password = $claveSMTP;
                $correoObj->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $correoObj->Port = $puertoSMTP;

                $correoObj->setFrom($correoRemitente, 'Ajetreados');
                $correoObj->addAddress($correoDestinatario);
                $correoObj->Subject = $asuntoCorreo;
                $correoObj->isHTML(true);
                $correoObj->Body = $cuerpoCorreo;
                $correoObj->CharSet = 'UTF-8';

                $correoObj->send();
                $_SESSION['mensajeRecuperarContrasena'] = "Correo enviado. Revisa tu bandeja de entrada.";
                header("Location: ../recuperar_contrasena.php");
                exit();
            } catch (Exception $e) {
                $_SESSION['mensajeRecuperarContrasena'] = "No se pudo enviar el correo. Inténtalo más tarde.";
                header("Location: ../recuperar_contrasena.php");
                exit();
            }
        } else {
            $_SESSION['mensajeRecuperarContrasena'] = "Hubo un problema con tu solicitud.";
            header("Location: ../recuperar_contrasena.php");
            exit();
        }
    } else {
        $_SESSION['mensajeRecuperarContrasena'] = "No encontramos una cuenta con ese correo.";
        header("Location: ../recuperar_contrasena.php");
        exit();
    }
}
?>
