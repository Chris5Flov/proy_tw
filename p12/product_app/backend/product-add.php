<?php
    require_once __DIR__.'/../vendor/autoload.php';
    use TecWeb\MyApi\Create\Create as Create;

    $prodObj = new Create('marketzone');
    $input = json_decode(file_get_contents("php://input"), true);
    $prodObj->add($input);

    echo $prodObj->getData();
?>