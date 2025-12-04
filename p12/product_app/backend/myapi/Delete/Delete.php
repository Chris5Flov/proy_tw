<?php 
namespace TecWeb\MyApi\Delete;
use TecWeb\MyApi\DataBase;
require_once __DIR__.'/../DataBase.php';

class Delete extends DataBase{
    public function __construct($db)
    {
        $this->data= array();
        parent::__construct($user='root', $pass='', $db);
    }
    public function delete($id){
        $this->data = array('status'  => 'error', 'message' => 'La consulta falló');
        if(isset($id)){
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
            if($this->conexion->query($sql)){
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto eliminado";
            } else {
            $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            
        }
        $this->conexion->close();
    }


}


?>