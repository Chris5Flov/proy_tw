<?php 
namespace TecWeb\MyApi;
abstract class DataBase {
    protected $conexion;
    protected $data = NULL;
    public function __construct($user, $pass, $db){
        $this->conexion = @mysqli_connect('localhost', $user, $pass, $db); 
        if(!$this->conexion){
            die('La Base de datos no ha sido conectada');
        }
    }
    public function getData(){
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}
?>