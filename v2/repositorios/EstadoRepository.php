<?php
include_once 'Conexion.php';

class EstadoRepository extends Conexion
{
    public function __construct() { parent::__construct(); }

    public function obtener_todos(){
        $query;
        $resultado;
        $datos;

        $query = "SELECT DISTINCT(Estado), EstadoId FROM CodigoPostal";
        $resultado = $this->mysqli->query($query);
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $datos;
    }
}