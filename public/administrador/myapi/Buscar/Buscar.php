<?php
namespace TrackVault\MyApi\Buscar;

use TrackVault\MyApi\DataBase;

class Buscar extends DataBase {

    public function ejecutar($search) {
        $search = $this->conexion->real_escape_string($search);
        $sql = "SELECT * FROM archivos 
                WHERE (nombre LIKE '%$search%' OR autor_o_empresa LIKE '%$search%')
                AND eliminado = 0";
        $result = $this->conexion->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
