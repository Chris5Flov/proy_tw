<?php
namespace TrackVault\MyApi\Obtener;

use TrackVault\MyApi\DataBase;

class Obtener extends DataBase {

    public function ejecutar($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM archivos WHERE id = $id";
        $result = $this->conexion->query($sql);
        return $result->fetch_assoc();
    }
}
?>