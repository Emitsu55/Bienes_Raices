<?php

namespace App;

class Propiedad
{

    //Base de Datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    //Errores 
    protected static $errores = [];


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

    //Definir la conexion a la BD
    public static function setDb($database)
    {
        Self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
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

    public function guardar()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ( ' ";
        $query .= join("', '", array_values($atributos));
        $query .= " '); ";

        $resultado = self::$db->query($query);
        
        return $resultado;
    }

    //identificar y unir atributos de la DB
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue; //escapa y continua al sig elemento
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    //Subida de archivos
    public function setImage($imagen){
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Validacion
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {

        if (!$this->titulo) {
            self::$errores[] = '*Debes añadir un titulo';
        }
        if (!$this->precio) {
            self::$errores[] = '*Debes añadir el precio';
        }
        if (strlen($this->descripcion) < 30) {
            $errores[] = '*La descripción es obligatoria y debe tener al menos 30 caracteres';
        }
        if (!$this->habitaciones) {
            self::$errores[] = '*Debes añadir el número de habitaciones';
        }
        if (!$this->wc) {
            self::$errores[] = '*Debes añadir el número de baños';
        }
        if (!$this->estacionamiento) {
            self::$errores[] = '*Debes añadir el número de estacionamientos';
        }
        if (!$this->vendedorId) {
            self::$errores[] = '*Elige un vendedor';
        }
        if (!$this->imagen) {
            self::$errores[] = '*Debes subir una imagen';
        }

        return self::$errores;
    }

    //Listar todas las propiedades
    public static function all() {
        $query = "SELECT * FROM propiedades;";

        $resultado = self::consultarSql($query);



        debuguear($resultado->fetch_assoc());
    }

    public static function consultarSql($query){
        //Consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados

        //Liberar memoria

        //Retornar los resultados
         
    }
}
