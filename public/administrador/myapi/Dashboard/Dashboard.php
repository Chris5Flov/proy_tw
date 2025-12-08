<?php
namespace TrackVault\MyApi\Dashboard;

use TrackVault\MyApi\DataBase;

class Dashboard extends DataBase {

    public function ejecutar() {
        $data = [];

        $total = $this->conexion->query(
            "SELECT COUNT(*) AS total FROM archivos WHERE eliminado = 0"
        )->fetch_assoc();
        $data["total"] = $total['total'];

        $tipos = $this->conexion->query(
            "SELECT tipo, COUNT(*) AS total FROM archivos WHERE eliminado = 0 GROUP BY tipo"
        );
        $data["por_tipo"] = $tipos->fetch_all(MYSQLI_ASSOC);

        $autores = $this->conexion->query(
            "SELECT autor_o_empresa AS autor, COUNT(*) AS total 
            FROM archivos WHERE eliminado = 0 
            GROUP BY autor_o_empresa ORDER BY total DESC LIMIT 5"
        );
        $data["top_autores"] = $autores->fetch_all(MYSQLI_ASSOC);

        return $data;
    }
}
?>