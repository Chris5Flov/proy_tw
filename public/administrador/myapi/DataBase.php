<?php 
namespace TrackVault\MyApi;

class DataBase {
    protected $conexion;

    public function __construct() {
        $this->conexion = new \mysqli("localhost", "root", "Tec&12Web", "track_vault");
        if ($this->conexion->connect_errno) {
            die(json_encode(["status" => "error", "message" => "Error de conexión: " . $this->conexion->connect_error]));
        }
        $this->conexion->set_charset("utf8mb4");
    }
}
?>