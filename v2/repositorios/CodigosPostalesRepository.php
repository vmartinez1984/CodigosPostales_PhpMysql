<?php
include_once 'EstadoRepository.php';
include_once 'AlcaldiaRepository.php';
include_once 'CodigoPostalRepository.php';

class CodigosPostalesRepository
{    
    public $estado;
    public $alcaldia;
    public $codigoPostal;

    function __construct(){
        $this->estado = new EstadoRepository();
        $this->alcaldia = new AlcadiaRepository();
        $this->codigoPostal = new CodigoPostalRepository();
    }
}
