<?php
require_once __DIR__ . '/../config/db.php';

class Cancion {
    private $conn;
    private $nombre_tabla = "canciones";

    public $id_cancion;
    public $titulo_cancion;
    public $portada_cancion;
    public $letra_cancion;

    public function __construct() {
        $db = new Db();
        $this->conn = $db->getConnection();
    }

    public function agregarCancion() {
        $query = "INSERT INTO " . $this->nombre_tabla . " (titulo_cancion, portada_cancion, letra_cancion)
                  VALUES (:titulo_cancion, :portada_cancion, :letra_cancion)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo_cancion", $this->titulo_cancion);
        $stmt->bindParam(":portada_cancion", $this->portada_cancion);
        $stmt->bindParam(":letra_cancion", $this->letra_cancion);

        return $stmt->execute();
    }

    public function obtenerCanciones() {
        $query = "SELECT * FROM " . $this->nombre_tabla . " ORDER BY id_cancion DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarCancion() {
        $query = "DELETE FROM " . $this->nombre_tabla . " WHERE id_cancion = :id_cancion";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_cancion", $this->id_cancion);

        return $stmt->execute();
    }

    public function actualizarCancion() {
        $query = "UPDATE " . $this->nombre_tabla . " 
                  SET titulo_cancion = :titulo_cancion, portada_cancion = :portada_cancion, letra_cancion = :letra_cancion 
                  WHERE id_cancion = :id_cancion";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo_cancion", $this->titulo_cancion);
        $stmt->bindParam(":portada_cancion", $this->portada_cancion);
        $stmt->bindParam(":letra_cancion", $this->letra_cancion);
        $stmt->bindParam(":id_cancion", $this->id_cancion);

        return $stmt->execute();
    }

    public function obtenerPorId() {
        $query = "SELECT * FROM " . $this->nombre_tabla . " WHERE id_cancion = :id_cancion LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_cancion", $this->id_cancion);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorTitulo($titulo) {
        $query = "SELECT * FROM canciones WHERE titulo_cancion LIKE :titulo ORDER BY id_cancion DESC";
        $stmt = $this->conn->prepare($query);
        $titulo = '%' . $titulo . '%';
        $stmt->bindParam(':titulo', $titulo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
