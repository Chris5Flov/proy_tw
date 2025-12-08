<?php
namespace TrackVault\MyApi\Eliminar;

use TrackVault\MyApi\DataBase;

class Eliminar extends DataBase {

    public function ejecutar($id) {
        $id = (int)$id;
        $sql = "UPDATE archivos SET eliminado = 1 WHERE id = $id";

        if ($this->conexion->query($sql)) {
            return ["status" => "success", "message" => "Archivo eliminado"];
        }

        return ["status" => "error", "message" => $this->conexion->error];
    }
}
?>