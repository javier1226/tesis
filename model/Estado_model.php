<?php
include_once 'Conexion.php';
class Estado
{
    var $objetos;
    public function __construct()
    {
        $db = new  Conexion();
        $this->acceso = $db->pdo;
    }

    //borrar
    function rellenar_estado_pago()
    {
        $sql = "SELECT * FROM estado_pago";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    //borrar
    function obtenerId($nombre)
    {
        $sql = "SELECT * FROM estado_pago WHERE nombre =:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre' => $nombre));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
