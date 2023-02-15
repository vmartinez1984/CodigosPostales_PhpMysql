<?php

class Conexion{

	public $mysqli;

	public function __construct(){        
        $this->mysqli = new mysqli("localhost", "root", "", "codigospostales");
        if ($this->mysqli->connect_errno) {
            echo "Error en la conexion" . $this->mysqli->connect_error;
        }
    }
}