<?php
namespace TrackVault\MyApi\Listar;

use TrackVault\MyApi\DataBase;

class Listar extends DataBase {

    public function ejecutar() {
        $sql = "SELECT * FROM archivos WHERE eliminado = 0";
        $result = $this->conexion->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>