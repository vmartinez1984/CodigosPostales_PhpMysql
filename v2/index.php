<?php
include_once 'repositorios/CodigosPostalesRepository.php';

$repository;
$url;
$uri;

$repository = new CodigosPostalesRepository();
if (isset($_SERVER["PATH_INFO"])) {
    $url = strtolower($_SERVER["PATH_INFO"]);
    $uri = explode("/", strtolower($_SERVER["PATH_INFO"]));
    //print_r($uri);
    //print_r($_SERVER);
    //header("Content-type: application/json; charset=UTF-8");
    header('autor: VictorMtz');
    header('info: La informacion se obtuvo en sepomex');
    // http://127.0.0.1:8080/codigosPostales/v2/index.php/api/estados
    if (str_contains($url, '/api/codigospostales/')) {
        $codigosPostales;

        $codigosPostales = $repository->codigoPostal->obtener_por_codigo_postal($uri[3]);

        echo json_encode($codigosPostales);
    } else if ($url == '/api/codigospostales/aleatorio') {
        $codigoPostal;

        $codigoPostal = $repository->codigoPostal->obtener_aleatorio();

        return $codigoPostal;
    } else if ($url == '/api/estados') {
        $estados;

        $estados = $repository->estado->obtener_todos();

        echo json_encode($estados);
    } else if ($uri[2] == 'estados' && $uri[4] == 'alcaldias' && (!isset($uri[5]) || $uri[5] == '')) {
        $alcaldias;

        $alcaldias = $repository->alcaldia->obtener_todos_por_estado($uri[3]);

        echo json_encode($alcaldias);
    }
    if ($uri[2] == 'estados' && $uri[4] == 'alcaldias' && isset($uri[5]) && $uri[5] != '') {
        $codigosPostales;

        $codigosPostales = $repository->codigoPostal->obtener_por_estado_y_alcadia($uri[3], $uri[5]);

        echo json_encode($codigosPostales);
    }
} else {
    include_once 'doc/index.html';
}
