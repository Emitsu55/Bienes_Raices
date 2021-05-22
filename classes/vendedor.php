<?php

namespace App;

class Vendedor extends ActiveRecord {

    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];
    protected static $tabla = 'vendedores';

    //Atributos
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    //constructor

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar() 
    {

        if (!$this->nombre) {
            self::$errores[] = '*Debes añadir el nombre';
        }
        if (!$this->apellido) {
            self::$errores[] = '*Debes añadir el apellido';
        }
        if (!$this->telefono) {
            self::$errores[] = '*Debes añadir un número de telefono';
        }

        //Validacon con una expresion regular (forma de buscar un patron en un texto)
        if(!preg_match('/[0-9]{10}/', $this->telefono)) {  //La expresion indica con las '//' que el tamaño es fijo, con '[0-9]' que debe llevar numeros del 1 al 9 y con '{10}' la cantidad de digitos
            self::$errores[] = '*Teléfono no valido';
        }

        return self::$errores;
    }

}