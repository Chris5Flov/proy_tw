<?php
    require_once __DIR__.'/../vendor/autoload.php';
    use TecWeb\MyApi\Delete\Delete as Delete; 
    
    $prodObj = new Delete('marketzone');
    $prodObj->delete($_POST['id']);

    echo $prodObj->getData();
?>