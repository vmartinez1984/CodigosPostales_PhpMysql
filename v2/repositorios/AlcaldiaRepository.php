<?php
include_once 'Conexion.php';

class AlcadiaRepository extends Conexion
{
    public function __construct()
    {
        parent::__construct();
    }

    public function obtener_todos_por_estado($estado){    
        $query;
        $resultado;
        $datos;
        $tipo;
        $sentencia;

        if(is_numeric($estado)){
            $query = "SELECT DISTINCT(Alcaldia), AlcaldiaId FROM codigopostal WHERE EstadoId = ? ORDER BY Alcaldia";
            //$estado = intval($estado);
            $tipo = "i";
        }else{
            $query = "SELECT DISTINCT(Alcaldia), AlcaldiaId FROM codigopostal WHERE Estado = ? ORDER BY Alcaldia";
            $tipo = "s";
        }
        //echo $query;
        $sentencia = $this->mysqli->prepare($query);
        $sentencia->bind_param($tipo, $estado);
        $sentencia->execute();        
        $resultado = $sentencia->get_result();        
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $datos;
    }
}
