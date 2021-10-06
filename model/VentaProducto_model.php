<?php
include 'Conexion.php';
class VentaProducto
{
    var $objetos;
    public function __construct()
    {
        $db = new  Conexion();
        $this->acceso = $db->pdo;
    }


    function ver($id){
        $sql="SELECT precio, cantidad, producto.nombre as producto, concentracion, adicional, laboratorio.nombre as laboratorio, presentacion.nombre as presentacion, tipo_producto.nombre as tipo, subtotal
        FROM venta_producto
        join producto on producto_id_producto = id_producto and venta_id_venta =:id
        join laboratorio on prod_lab = id_laboratorio
        join tipo_producto on prod_tip_prod = id_tip_prod
        join presentacion on prod_present = id_presentacion";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=> $id));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
