<?php
namespace TrackVault\MyApi\Editar;

use TrackVault\MyApi\DataBase;

class Editar extends DataBase {

    public function ejecutar($data) {

        if (empty($data['nombre']) || empty($data['autor_o_empresa']) ||
            empty($data['descripcion']) || empty($data['ruta_archivo'])) {

            return ["status" => "error", "message" => "Error del Servidor: No puedes dejar campos vacíos."];
        }

        $stmt = $this->conexion->prepare(
            "UPDATE archivos SET nombre=?, autor_o_empresa=?, descripcion=?, tipo=?, ruta_archivo=? WHERE id=?"
        );

        $stmt->bind_param("sssssi",
            $data['nombre'],
            $data['autor_o_empresa'],
            $data['descripcion'],
            $data['tipo'],
            $data['ruta_archivo'],
            $data['id']
        );

        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Archivo actualizado correctamente"];
        }

        return ["status" => "error", "message" => $stmt->error];
    }
}
?>