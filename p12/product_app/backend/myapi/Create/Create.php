<?php 
namespace TecWeb\MyApi\Create;
use TecWeb\MyApi\DataBase as DataBase;
require_once __DIR__. '/../DataBase.php';

class Create extends DataBase{
    public function __construct($db)
    {
        $this->data = array();
        parent::__construct($user='root', $pass='', $db);
    }

    public function add($obj){
        $this->data = array('status' => 'error', 'message' => 'Producto no agregado');
        if(isset($obj['nombre'])){
            $jsonOBJ=json_decode(json_encode($obj));
            $this->conexion->set_charset("utf8");
            $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
            if($this->conexion->query($sql)){
                $this->data['status'] ="success";
                $this->data['message'] = "Producto agregado";
            } else {
                $this->data['message'] = "ERROR: No se ejecutó $sql. ".mysqli_error($this->conexion);
            }
        }
        $this->conexion->close();
    }
}


?>