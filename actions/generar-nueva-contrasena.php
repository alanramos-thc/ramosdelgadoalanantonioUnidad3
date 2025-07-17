<?php

require_once __DIR__ . '/../config/db.php';

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $token = $_POST['token'] ?? '';
        $nuevaContrasenaPlana = $_POST['nueva_contrasena'] ?? '';
        $confirmarContrasena = $_POST['confirmar_nueva_contrasena'] ?? '';

        if (empty($token) || empty($nuevaContrasenaPlana) || $nuevaContrasenaPlana !== $confirmarContrasena) {
            throw new Exception("Datos incompletos o las contraseñas no coinciden");
        }

        $db = new Db();
        $pdo = $db->getConnection();

        $sqlIntegrante = "SELECT id_integrante, token_integrante FROM integrantes";
        $stmtIntegrante = $pdo->prepare($sqlIntegrante);
        $stmtIntegrante->execute();
        $id = null;
        $tabla = null;
        $campoId = null;
        $campoToken = null;
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
            $sqlInvitado = "SELECT id_invitado, token_invitado FROM invitados";
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
            throw new Exception("Token inválido o expirado");
        }

        $nuevaContrasenaHash = password_hash($nuevaContrasenaPlana, PASSWORD_BCRYPT);
        if (!$nuevaContrasenaHash) {
            throw new Exception("Error al generar la nueva contraseña");
        }

        $pdo->beginTransaction();
        $columnaContrasena = ($tabla === 'integrantes') ? 'contrasena_integrante' : 'contrasena_invitado';
        $sqlUpdate = "UPDATE $tabla SET $columnaContrasena = ?, $campoToken = NULL WHERE $campoId = ?";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        if (!$stmtUpdate) {
            throw new Exception("Error en la preparación de la consulta");
        }
        $resultado = $stmtUpdate->execute([$nuevaContrasenaHash, $id]);
        if (!$resultado) {
            throw new Exception("Error al actualizar la contraseña");
        }
        $filasAfectadas = $stmtUpdate->rowCount();
        if ($filasAfectadas === 0) {
            $pdo->rollBack();
            throw new Exception("Usuario no encontrado");
        }
        $pdo->commit();
        header("Location: ../contrasena_actualizada.html");
        exit;
    } else {
        throw new Exception("Método no permitido");
    }

    } catch (Exception $e) {
        if (isset($pdo) && $pdo->inTransaction()) {
            $pdo->rollBack();
        }
        echo 'Excepción capturada: ' . $e->getMessage();
    }
?>
