<?php
$mysqli= require_once __DIR__ ."/login/database.php";

require_once __DIR__ . "/archivosmanager.php";


if (!isset($_GET['id'])){
    http_response_code(400);
    exit("ID no proporcionado");
}

$id = intval($_GET['id']);

class ArchivoDescargaManager extends ArchivosManager{
    public function obtenerArchivoPorId($id){
        $sql = "SELECT id, nombre, tipo, descripcion, ruta_archivo FROM archivos WHERE eliminado = 0 and id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        if($stmt->execute()){
            $resultado = $stmt->get_result();
            return $resultado->fetch_assoc();
        }
        return null;
    }
}

$manager = new ArchivoDescargaManager($mysqli);
$archivo = $manager->obtenerArchivoPorId($id);

if(!$archivo){
    http_response_code(404);
    exit("Archivo no encontrado.");
}
$ruta_relativa= $archivo["ruta_archivo"];
$ruta_real=realpath(__DIR__ . "/"  . $ruta_relativa);

//var_dump($ruta_real);
//var_dump(file_exists($ruta_real));

if(!$ruta_real || !file_exists($ruta_real)){
    http_response_code(404);
    exit("El archivo no existe en el servidor.");
}

$nombre_descarga = $archivo["nombre"] . "." . $archivo["tipo"];

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$nombre_descarga\"");
header("Content-Length: " . filesize($ruta_real));

readfile($ruta_real);

?>