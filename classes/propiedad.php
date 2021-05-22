<?php

namespace App;

class Propiedad extends ActiveRecord {

    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 
    'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    protected static $tabla = 'propiedades';

    //Atributos
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    //Constructor
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar() 
    {

        if (!$this->titulo) {
            static::$errores[] = '*Debes añadir un titulo';
        }
        if (!$this->precio) {
            static::$errores[] = '*Debes añadir el precio';
        }
        if (strlen($this->descripcion) < 30) {
            $errores[] = '*La descripción es obligatoria y debe tener al menos 30 caracteres';
        }
        if (!$this->habitaciones) {
            static::$errores[] = '*Debes añadir el número de habitaciones';
        }
        if (!$this->wc) {
            static::$errores[] = '*Debes añadir el número de baños';
        }
        if (!$this->estacionamiento) {
            static::$errores[] = '*Debes añadir el número de estacionamientos';
        }
        if (!$this->vendedorId) {
            static::$errores[] = '*Elige un vendedor';
        }
        if (!$this->imagen) {
            static::$errores[] = '*Debes subir una imagen';
        }

        return static::$errores;
    }
}
