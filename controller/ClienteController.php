<?php
include '../model/Cliente_model.php';
$cliente = new Cliente();

if ($_POST['funcion'] == 'buscar') {
    $cliente->buscar();
    date_default_timezone_set('America/Lima');
    $fecha = date('Y-m-d H:i:s');
    $fecha_actual = new DateTime($fecha);
    $json = array();
    foreach ($cliente->objetos as $objeto) {
        $nac = new DateTime($objeto->edad);
        $edad = $nac->diff($fecha_actual);
        $edad_y = $edad->y;
        $json[] = array(
            'id' => $objeto->id,
            'nombre' => $objeto->nombre . ' ' . $objeto->apellidos,
            'dni' => $objeto->dni,
            'edad' => $edad_y,
            'telefono' => $objeto->telefono,
            'correo' => $objeto->correo,
            'sexo' => $objeto->sexo,
            'adicional' => $objeto->adicional,
            'avatar' => '../img/myAvatar.png'
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

//crear
if ($_POST['funcion'] == 'crear') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $adicional = $_POST['adicional'];
    $avatar = 'myAvatar.png';

    $cliente->crear($nombre, $apellidos, $dni, $edad, $telefono, $correo, $sexo, $adicional, $avatar);
}

//editar
if ($_POST['funcion'] == 'editar') {
    $id = $_POST['id'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $adicional = $_POST['adicional'];

    $cliente->editar($id, $telefono, $correo, $adicional);
}

if ($_POST['funcion'] == 'borrar') {
    $id = $_POST['id'];
    $cliente->borrar($id);
}

if ($_POST['funcion'] == 'rellenar_clientes') {    
    $cliente->rellenar_clientes();
    $json = array();
    foreach ($cliente->objetos as $objeto) {        
        $json[] = array(
            'id' => $objeto->id,
            'nombre' => $objeto->nombre . ' ' . $objeto->apellidos .' | '. $objeto->dni
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
