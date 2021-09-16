<?php
include 'Conexion.php';
class Proveedor{
     var $objetos;
     public function __construct() {
         $db= new  Conexion();
         $this->acceso=$db->pdo;
     }
     function crear($nombre,$telefono,$correo,$direccion,$avatar){
        $sql="SELECT id_proveedor FROM proveedor where nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd'; 
        }
        else{
            $sql="INSERT INTO proveedor(nombre,telefono,correo,direccion,avatar) values (:nombre,:telefono,:correo,:direccion,:avatar);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,':direccion'=>$direccion,':avatar'=>$avatar));
            echo 'add';
        }

    }
    function editar($nombre,$id_editado){
        $sql="UPDATE laboratorio SET nombre=:nombre where id_laboratorio=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre));
        echo 'edit';

    }
    function buscar(){

        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT * FROM proveedor where nombre LIKE :consulta";
           $query=$this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%"));
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }else{
           $sql="SELECT * FROM proveedor where nombre NOT LIKE '' ORDER BY id_proveedor desc LIMIT 25";
           $query=$this->acceso->prepare($sql);
           $query->execute();
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
    } 

    function cambiar_logo($id, $nombre)
    {
        $sql = "UPDATE proveedor SET avatar=:nombre where id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id, ':nombre' => $nombre));
    }

    function borrar($id)
    {
        $sql = "DELETE FROM proveedor where id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'borrado';
        } else {
            echo 'noborrado';
        }
    }
}

?>