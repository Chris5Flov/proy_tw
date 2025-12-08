<?php

class ArchivosManager {

    protected $db; 

    public function __construct($mysqli) {
        $this->db = $mysqli;
    }

    public function obtenerArchivos($tipo = "Todos", $search = "") {

        $tipo   = $this->db->real_escape_string($tipo);
        $search = $this->db->real_escape_string($search);

        $sql = "SELECT id, nombre, tipo, descripcion 
                FROM archivos 
                WHERE eliminado = 0";

        if ($tipo !== "Todos" && $tipo !== "All") {
            $sql .= " AND tipo = '$tipo'";
        }

        if (!empty($search)) {
            $sql .= " AND (
                        id LIKE '%$search%' 
                        OR nombre LIKE '%$search%' 
                        OR descripcion LIKE '%$search%' 
                        OR autor_o_empresa LIKE '%$search%'
                    )";
        }

        $sql .= " ORDER BY nombre ASC";

        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
