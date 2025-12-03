<?php 
namespace TecWeb\MyApi\Update;
use TecWeb\MyApi\DataBase as DataBase;
require_once __DIR__.'/../DataBase.php';

class Update extends DataBase{
    public function __construct($db)
    {
        $this->data=array();
        parent::__construct($user='root', $pass='', $db);
    }

    public function edit($obj){
        $this->data = array('status'  => 'error', 'message' => 'Ya existe un producto con ese nombre');
        if(isset($obj['id'])){
            $jsonOBJ=json_decode(json_encode($obj));
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND id != '{$jsonOBJ->id}' AND eliminado = 0";
            $result = $this->conexion->query($sql);

            if($result->num_rows == 0){  
                $this->conexion->set_charset("utf8");
                $sql = "UPDATE productos SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', 
                unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = '{$jsonOBJ->id}'";
                if($this->conexion->query($sql)){
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "Producto editado";
                } else {
                    $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
            } 
        }
        $this->conexion->close();
    }
    

}   


?>