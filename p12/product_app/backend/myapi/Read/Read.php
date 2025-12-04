<?php 
namespace TecWeb\MyApi\Read;
use TecWeb\MyApi\DataBase as DataBase;
require_once __DIR__.'/../DataBase.php';

class Read extends DataBase{
    public function __construct($db)
    {
        $this->data= array();
        parent::__construct($user='root', $pass='', $db);
    }
    
    public function list(){
        $this->data = array();
        if($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado=0")){
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(!is_null($rows)){
                foreach($rows as $num => $row){
                    foreach($row as $key => $value){
                        $this->data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else{
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function search($search){
        if(isset($search)){
            $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
            if ($result = $this->conexion->query($sql) ) {
			$rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = utf8_encode($value);
                        }
                    }
                }
			    $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
        }
        $this->conexion->close();
    }

    public function single($id){
        $this->data = array();
        if(isset($id)){
            $sql = "SELECT * FROM productos WHERE id = $id AND eliminado = 0";
            if($result = $this->conexion->query($sql)){
                $row = $result->fetch_assoc();
                if(!is_null($row)){
                    foreach($row as $key => $value){
                        $this->data[$key] = utf8_encode($value);
                    }
                }
                $result->free();
            } else{
                die('Query Error: '.mysqli_error($this->conexion));
            }
        }
        $this->conexion->close();
    }

    public function singleByName($nombre){
        $this->data = array();
        if(isset($nombre)){
            $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
            if($result = $this->conexion->query($sql)){
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                if(count($rows) > 0){
                    $this->data = ['status' => 'error', 'message' => 'Ya existe un producto con ese nombre.'];
                } else {
                    $this->data = ['status' => 'success', 'message' => 'Producto disponible para agregar/modificar.'];
                }
                $result->free();
            } else {
                $this->data = ['status' => 'error', 'message' => 'Error en la consulta: '.mysqli_error($this->conexion)];
            }
        }
        $this->conexion->close();
    }


}


?>