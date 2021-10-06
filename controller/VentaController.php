<?php
include '../model/Venta_model.php';
date_default_timezone_set('America/Lima');
$venta = new Venta();

if ($_POST['funcion'] == 'listar') {
    $venta->buscar();
    $json=array();
    foreach ($venta->objetos as $objeto) {
        $json['data'][] = $objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}