<?php

// de esta forma evito colocar todo el codigo del includes
// El dir enlaza la direccion exacta y le permite a php rastrear el archivo

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');


function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {
    session_start();

    // if(!$_SESSION['login']) {
    //     header('Location /');
    // }

}

function debuguear($variable) {

    echo '<pre>';
    var_dump($variable);
    echo '<pre>';
    exit;
}

//Escapa /sanitiza el html
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido 
function validarTipoContenido($tipo) {
    $tipos = ['propiedad', 'vendedor'];

    return in_array($tipo, $tipos);
}

//Muestra las alertas
function mostrarNotificaion($codigo) {
    $mensaje = [];

    switch($codigo) {

        case 1:
            $mensaje = 'Registro Exitoso';
            break;
        case 2: 
            $mensaje = 'Registro Actualizado';
            break;
        case 3: 
            $mensaje = 'Registro Eliminado'; 
            break;
        default: 
            $mensaje = false;
            break;

        } 
        return $mensaje;

}