<?php
include 'Conexion.php';
class Cliente
{
    var $objetos;
    public function __construct()
    {
        $db = new  Conexion();
        $this->acceso = $db->pdo;
    }

    //buscar
    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM cliente where estado = 'A' and nombre LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM cliente where estado = 'A' and nombre NOT LIKE '' ORDER BY id desc LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    //crear cliente modelo
    function crear($nombre, $apellidos, $dni, $edad, $telefono, $correo, $sexo, $adicional, $avatar)
    {
        $sql = "SELECT id, estado FROM cliente where (nombre=:nombre and apellidos=:apellidos) or dni=:dni";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre' => $nombre, ':apellidos' => $apellidos, ':dni' => $dni));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            foreach ($this->objetos as $cli) {
                $cli_id = $cli->id;
                $cli_estado = $cli->estado;
            }
            if ($cli_estado == 'A') {
                echo 'noadd';
            } else {
                $sql = "UPDATE cliente SET estado='A' where id=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id' => $cli_id));
                echo 'add';
            }
        } else {
            $sql = "INSERT INTO cliente(nombre, apellidos, dni, edad, telefono, correo, sexo, adicional, avatar) values (:nombre, :apellidos, :dni, :edad, :telefono, :correo, :sexo, :adicional, :avatar);";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre' => $nombre, ':apellidos' => $apellidos, ':dni' => $dni, ':edad' => $edad, ':telefono' => $telefono, ':correo' => $correo, ':sexo' => $sexo, ':adicional' => $adicional, ':avatar' => $avatar));
            echo 'add';
        }
    }
}
