<?php
include '../model/Estado_model.php';

$estado = new Estado();
session_start();
if ($_POST['funcion'] == 'rellenar_estado_pago') {    
    $estado->rellenar_estado_pago();
    $json = array();
    foreach ($estado->objetos as $objeto) {        
        $json[] = array(
            'id' => $objeto->id,
            'nombre' => $objeto->nombre
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cambiarEstado') {    
    $nombre = $_POST['estado'];
    $estado->obtenerId($nombre);
    $json = array();
    foreach ($estado->objetos as $objeto) {        
        $json[] = array(
            'id' => $objeto->id
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}