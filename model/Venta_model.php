<?php
include_once 'Conexion.php';
class Venta
{
    var $objetos;
    public function __construct()
    {
        $db = new  Conexion();
        $this->acceso = $db->pdo;
    }
    function Crear($cliente, $total, $fecha, $vendedor)
    {
        $sql = "INSERT INTO venta(fecha, total, vendedor, id_cliente) VALUES (:fecha, :total, :vendedor, :cliente)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha' => $fecha, ':total' => $total, ':vendedor' => $vendedor, ':cliente' => $cliente));
    }

    function ultima_venta()
    {
        $sql = "SELECT MAX(id_venta) as ultima_venta FROM venta";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function borrar($id_venta)
    {
        $sql = "DELETE FROM venta where id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
        echo 'delete';
    }

    function buscar()
    {
        $sql = "SELECT id_venta, fecha, cliente, dni, total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor, id_cliente FROM venta join usuario on vendedor=id_usuario";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function verificar($id_venta, $id_usuario)
    {
        $sql = "SELECT * FROM venta WHERE vendedor = :id_usuario and id_venta = :id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario' => $id_usuario, ':id_venta' => $id_venta));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            return 1;
        } else {
            return 0;
        }
    }

    function recuperar_vendedor($id_venta)
    {
        $sql = "SELECT us_tipo FROM venta join usuario on id_usuario = vendedor WHERE id_venta = :id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function venta_dia_vendedor($id_usuario)
    {
        $sql = "SELECT SUM(total) as venta_dia_vendedor FROM venta WHERE vendedor=:id_usuario and date(fecha) = date(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario' => $id_usuario));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function venta_diaria()
    {
        $sql = "SELECT SUM(total) as venta_diaria FROM venta WHERE date(fecha) = date(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function venta_mensual()
    {
        $sql = "SELECT SUM(total) as venta_mensual FROM venta WHERE year(fecha) = year(curdate()) and month(fecha) = month(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function venta_anual()
    {
        $sql = "SELECT SUM(total) as venta_anual FROM venta WHERE year(fecha) = year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function buscar_id($id_venta)
    {
        $sql = "SELECT id_venta, fecha, cliente, dni, total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor, id_cliente FROM venta join usuario on vendedor=id_usuario and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function venta_mes()
    {
        $sql = "SELECT SUM(total) as cantidad, month(fecha) as mes FROM venta WHERE year(fecha)=year(curdate()) GROUP BY month(fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function vendedor_mes()
    {
        $sql = "SELECT CONCAT(usuario.nombre_us, ' ', usuario.apellidos_us)as vendedor_nombre, SUM(total) as cantidad FROM `venta` join usuario on id_usuario = vendedor where month(fecha) = month(curdate()) and year(fecha) = year(curdate()) GROUP BY vendedor ORDER BY cantidad DESC LIMIT 3";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function ventas_anual()
    {
        $sql = "SELECT SUM(total) as cantidad, month(fecha) as mes FROM venta WHERE year(fecha)=year(date_add(curdate(), INTERVAL -1 YEAR)) GROUP BY month(fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function producto_mas_vendido()
    {
        $sql = "SELECT nombre, concentracion, adicional, SUM(cantidad) as total FROM `venta`
        JOIN venta_producto ON id_venta = venta_id_venta
        JOIN producto ON id_producto = producto_id_producto
        WHERE year(fecha) = year(curdate()) and month(fecha) = month(curdate())
        GROUP BY producto_id_producto ORDER BY total DESC LIMIT 5";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function cliente_mes()
    {
        $sql = "SELECT CONCAT(cliente.nombre, ' ', cliente.apellidos)as cliente_nombre, SUM(total) as cantidad 
        FROM `venta` 
        join cliente on id_cliente = id 
        where month(fecha) = month(curdate()) 
        and year(fecha) = year(curdate()) 
        GROUP BY id_cliente 
        ORDER BY cantidad 
        DESC LIMIT 3";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function monto_costo()
    {
        $sql = "SELECT SUM(det_cantidad * precio_compra) as monto_costo
        FROM detalle_venta 
        join venta on id_det_venta = id_venta and year(fecha) = year(curdate()) and month(fecha) = month(curdate())
        join lote on id__det_lote = lote.id";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
