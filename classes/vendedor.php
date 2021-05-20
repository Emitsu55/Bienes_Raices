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
        $this->telefono = $args['precio'] ?? '';
    }

    public function validar() 
    {

        if (!$this->nombre) {
            static::$errores[] = '*Debes añadir el nombre';
        }
        if (!$this->apellido) {
            static::$errores[] = '*Debes añadir el apellido';
        }
        if (!$this->telefono) {
            static::$errores[] = '*Debes añadir un número de telefono';
        }

        return static::$errores;
    }

}