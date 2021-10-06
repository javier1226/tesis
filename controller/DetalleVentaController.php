<?php
include_once '../model/VentaProducto_model.php';
include_once '../model/DetalleVenta_model.php';
include_once '../model/Venta_model.php';
include_once '../model/Lote_model.php';

$lote = new Lote();
$venta = new Venta();
$detalle_venta = new DetalleVenta();
$venta_producto = new VentaProducto();

if ($_POST['funcion'] == 'borrar_venta') {

    $id_venta=$_POST['id'];
}
?>