<?php
include 'Conexion.php';
class Producto{
     var $objetos;
     public function __construct() {
         $db= new  Conexion();
         $this->acceso=$db->pdo;
     }
     function crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar){
        $sql="SELECT id_producto FROM producto where nombre=:nombre and concentracion=:concentracion and adicional=:adicional and prod_lab=:laboratorio and prod_tip_prod=:tipo and prod_present=:presentacion";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd'; 
        }
        else{
            $sql="INSERT INTO producto(nombre,concentracion,adicional,precio,prod_lab,prod_tip_prod,prod_present,avatar) values (:nombre,:concentracion,:adicional,:precio,:laboratorio,:tipo,:presentacion,:avatar);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion,':precio'=>$precio,':avatar'=>$avatar));
            echo 'add';
        }

    }
    // function editar($nombre,$id_editado){
    //     $sql="UPDATE laboratorio SET nombre=:nombre where id_laboratorio=:id";
    //     $query=$this->acceso->prepare($sql);
    //     $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre));
    //     echo 'edit';

    function buscar(){

        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT id_producto,producto.nombre as nombre,concentracion,adicional,precio, laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo,presentacion.nombre as presentacion,producto.avatar as avatar
           FROM producto
           join laboratorio on prod_lab=id_laboratorio
           join tipo_producto on prod_tip_prod=id_tip_prod
           join presentacion on prod_present=id_presentacion and producto.nombre  like :consulta limit 25";
           $query=$this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%"));
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }else{
           $sql="SELECT id_producto,producto.nombre as nombre,concentracion,adicional,precio, laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo,presentacion.nombre as presentacion,producto.avatar as avatar
           FROM producto
           join laboratorio on prod_lab=id_laboratorio
           join tipo_producto on prod_tip_prod=id_tip_prod
           join presentacion on prod_present=id_presentacion and producto.nombre not like '' ORDER BY producto.nombre limit 25";
           $query=$this->acceso->prepare($sql);
           $query->execute();
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
    } 

    // function cambiar_logo($id,$nombre){
    //     $sql="SELECT avatar FROM laboratorio where id_laboratorio=:id";
    //     $query = $this->acceso->prepare($sql);
    //     $query->execute(array(':id'=>$id));
    //     $this->objetos=$query->fetchall();
       
    //         $sql="UPDATE laboratorio SET avatar=:nombre where id_laboratorio=:id";
    //         $query=$this->acceso->prepare($sql);
    //         $query->execute(array(':id'=>$id,':nombre'=>$nombre));
    //     return $this->objetos;
    // }
    // function borrar($id){
    //     $sql="DELETE FROM laboratorio where id_laboratorio=:id";
    //     $query=$this->acceso->prepare($sql);
    //     $query->execute(array(':id'=>$id));
    //     if(!empty($query->execute(array(':id'=>$id)))){
    //      echo 'borrado';
            
    //     }else{
    //         echo 'noborrado';
    //     }
    // }
    
    // function rellenar_laboratorios(){
    //     $sql="SELECT * FROM laboratorio order by nombre asc";
    //     $query = $this->acceso->prepare($sql);
    //     $query->execute();
    //     $this->objetos=$query->fetchall();
    //     return $this->objetos;

    // }
    
}
?>