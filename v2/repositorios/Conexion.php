<?php

class Conexion{

	public $mysqli;

	public function __construct(){        
        $this->mysqli = new mysqli("192.168.1.86:3307", "root", "123456", "codigospostales");
        if ($this->mysqli->connect_errno) {
            echo "Error en la conexion" . $this->mysqli->connect_error;
        }
    }
}