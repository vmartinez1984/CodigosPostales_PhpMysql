<?php

require 'flight/Flight.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=CodigosPostales','root',''));

// Flight::route('/', function($route){
//     // Array of HTTP methods matched against
//     $route->methods;

//     // Array of named parameters
//     $route->params;

//     // Matching regular expression
//     $route->regex;

//     // Contains the contents of any '*' used in the URL pattern
//     $route->splat;
// }, true);

header('autor: VictorMtz');
header('info: La informacion se obtuvo en sepomex');

Flight::route('/Estados', function () {
    $sentencia = Flight::db()->prepare("SELECT DISTINCT(Estado), EstadoId FROM CodigoPostal");
    $sentencia->execute();
    $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    //print_r($datos);

    Flight::json($datos, 200);
});

Flight::route('/CodigosPostales/@codigoPostal', function ($codigoPostal) {
    $sentencia = Flight::db()->prepare("SELECT * FROM CodigoPostal WHERE CodigoPostal = ?");
    $sentencia->bindParam(1, $codigoPostal);
    $sentencia->execute();
    $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    //print_r($datos);

    Flight::json($datos, 200);
});


Flight::route('/Estados/@estadoId/alcaldias', function ($estadoId) {
    $sentencia = Flight::db()->prepare("SELECT DISTINCT(Alcaldia), AlcaldiaId FROM codigopostal WHERE EstadoId = ? ORDER BY Alcaldia");
    $sentencia->bindParam(1,$estadoId);
    $sentencia->execute();
    $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    // print_r($datos);

    Flight::json($datos, 200);    
});

Flight::route('/Estados/@estadoId/alcaldias/@alcaldiaId', function ($estadoId, $alcaldiaId) {
    $sentencia = Flight::db()->prepare("SELECT * FROM codigopostal WHERE EstadoId = ? AND AlcaldiaId = ?");
    $sentencia->bindParam(1, $estadoId, PDO::PARAM_INT);
    $sentencia->bindParam(2, $alcaldiaId, PDO::PARAM_INT);
    $sentencia->execute();
    $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    // print_r($datos);
    //echo $estadoId." ".$alcaldiaId;

    Flight::json($datos, 200);    
});

// Flight::route('/', function () {
//     echo 'hello world!';
// });

Flight::start();
