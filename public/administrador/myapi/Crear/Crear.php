<?php
namespace TrackVault\MyApi\Crear;

use TrackVault\MyApi\DataBase;

class Crear extends DataBase {

    public function ejecutar($data) {
        if (empty($data['nombre']) || empty($data['autor_o_empresa']) ||
            empty($data['descripcion']) || empty($data['ruta_archivo'])) {

            return ["status" => "error", "message" => "Faltan datos obligatorios"];
        }

        $stmt = $this->conexion->prepare(
            "INSERT INTO archivos (nombre, autor_o_empresa, descripcion, tipo, ruta_archivo, eliminado)
            VALUES (?, ?, ?, ?, ?, 0)"
        );
        $stmt->bind_param("sssss", 
            $data['nombre'], 
            $data['autor_o_empresa'], 
            $data['descripcion'], 
            $data['tipo'], 
            $data['ruta_archivo']
        );

        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Archivo guardado en TrackVault"];
        }

        return ["status" => "error", "message" => $stmt->error];
    }
}
