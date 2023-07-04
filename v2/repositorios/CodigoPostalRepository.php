<?php
include_once 'Conexion.php';

class CodigoPostalRepository extends Conexion
{
    public function __construct() { parent::__construct(); }

    public function obtener_por_estado_y_alcadia($estado, $alcaldia){
        $query;
        $resultado;
        $datos;
        $tipo;
        $sentencia;

        if (is_numeric($estado) && is_numeric($alcaldia)) {
            $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE EstadoId = ? AND AlcaldiaId = ?";
            $tipo = "ii";
        } else if (is_numeric($estado) && !is_numeric($alcaldia)) {
            $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE EstadoId = ? AND Alcaldia = ?";
            $tipo = "is";
        }else if (!is_numeric($estado) && is_numeric($alcaldia)) {
            $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE Estado = ? AND AlcaldiaId = ?";
            $tipo = "si";
        }else if (!is_numeric($estado) && !is_numeric($alcaldia)) {
            $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE Estado = ? AND Alcaldia = ?";
            $tipo = "ss";
        }
        //echo $query;
        $sentencia = $this->mysqli->prepare($query);
        $sentencia->bind_param($tipo, $estado, $alcaldia);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $datos;
    }

    public function obtener_por_codigo_postal($codigoPostal){
        $query;
        $resultado;
        $datos;
        $sentencia;

        $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM CodigoPostal WHERE CodigoPostal = ?";
        $sentencia = $this->mysqli->prepare($query);
        $sentencia->bind_param('s', $codigoPostal);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $datos;
    }

    public function obtener_aleatorio(){
        $query;
        $resultado;
        $datos;
        $sentencia;
        $id;
        $total;
        
        $total = "SELECT COUNT(id) FROM codigopostal";
        $id = rand(1, $total);
        $query = "SELECT codigoPostal, estado, estadoId, alcaldia, alcaldiaId, tipoDeAsentamiento, asentamiento FROM codigopostal WHERE id = ? LIMIT 1";
        $sentencia = $this->mysqli->prepare($query);
        $sentencia->bind_param('i', $id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $datos;
    }
}