<?php
    require_once __DIR__.'/../vendor/autoload.php';
    use TecWeb\MyApi\Read\Read as Read;

    $prodObj = new Read('marketzone');
    $prodObj->singleByName($_POST['name']);
    echo $prodObj->getData();
 ?>