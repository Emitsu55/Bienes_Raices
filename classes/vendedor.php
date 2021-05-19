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

}