<?php
class ArchivosManager {
    private $db;

    public function __construct($databaseConnection) {
        $this->db = $databaseConnection;
    }

    /*
     * Obtiene una lista de archivos, filtrando por tipo y excluyendo los eliminados.
     * @param string $tipo_filtro ('Todos', 'XML', 'PDF', etc.)
     * @return array La lista de archivos (array asociativo)
     */
    public function obtenerArchivos($tipo_filtro = 'Todos') {
        
        $sql = "SELECT nombre, tipo, descripcion, ruta_archivo FROM archivos WHERE eliminado = 0";
        
        if ($tipo_filtro !== 'Todos') {
            $sql .= " AND tipo = ?";
            
            $stmt = $this->db->prepare($sql . " ORDER BY nombre ASC"); 
            $stmt->bind_param("s", $tipo_filtro);
        } else {
            $stmt = $this->db->prepare($sql . " ORDER BY nombre ASC");
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC); 
        } else {
            error_log("Error al ejecutar consulta de archivos: " . $stmt->error);
            return [];
        }
    }
}
?>