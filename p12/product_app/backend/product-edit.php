<?php
    require_once __DIR__.'/../vendor/autoload.php';
    use TecWeb\MyApi\Update\Update as Update;

    $json = json_decode(file_get_contents("php://input"), true);
    $prodObj = new Update('marketzone');
    $prodObj->edit($json);

    echo $prodObj->getData();
?>
