<?php
require_once __DIR__ . '/../config/db.php';

class Integrante {
    private $conn;
    private $nombre_tabla = "integrantes";

    public $numero_telefono_integrante;
    public $contrasena_integrante;

    public function __construct() {
        $db = new Db();
        $this->conn = $db->getConnection();
    }

    public function IniciarSesion() {
        $query = "SELECT * FROM " . $this->nombre_tabla . " WHERE numero_telefono_integrante = :numero_telefono_integrante LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numero_telefono_integrante", $this->numero_telefono_integrante);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            if (password_verify($this->contrasena_integrante, $row['contrasena_integrante'])) {
                unset($row['contrasena_integrante']);
                return $row;
            }
        }
        return false;
    }
}
