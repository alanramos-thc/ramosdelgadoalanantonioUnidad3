<?php
require_once __DIR__ . '/../config/db.php';

class Invitado {
    private $conn;
    private $nombre_tabla = "invitados";

    public $numero_telefono_invitado;
    public $contrasena_invitado;

    public function __construct() {
        $db = new Db();
        $this->conn = $db->getConnection();
    }

    public function IniciarSesion() {
        $query = "SELECT * FROM " . $this->nombre_tabla . " WHERE numero_telefono_invitado = :numero_telefono_invitado LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numero_telefono_invitado", $this->numero_telefono_invitado);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            if (password_verify($this->contrasena_invitado, $row['contrasena_invitado'])) {
                unset($row['contrasena_invitado']);
                return $row;
            }
        }
        return false;
    }
}
