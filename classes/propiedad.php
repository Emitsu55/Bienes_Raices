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
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardar() {
        
        if(isset($this->id)) {
            //Actualizar 
            $this->actualizar();
        } else {
            //Crear nuevo registro
            $this->crear();
            
        }
    }

    public function crear()
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

    public function actualizar() {
        //sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach($atributos as $key=>$value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores); //Une valores de un array en un string y los separa por una ','
        $query .= " WHERE  id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1;";

        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location: /admin?resultado=2');  //query string
        }
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

        //eliminar imagen anterior
        if(isset($this->id)){   //isset revisa que exista y que ademas tenga un valor
            //Comprobar si existe el archivo
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            
            if($existeArchivo) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
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

        
        return $resultado;

    }

    //Buscar un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM propiedades WHERE id = ${id}";

        $resultado = self::consultarSql(($query));

        return array_shift($resultado); //Array_shift devuelve la primer posicion de un arreglo
    }

    public static function consultarSql($query){
        //Consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        //Liberar memoria
        $resultado->free();

        //Retornar los resultados
        return $array; 
    }

    protected static function crearObjeto($registro){

        $objeto = new self;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) { //Compara si el primero objeto, tiene la propiedad '$key'

                $objeto->$key = $value; //Le inserta en la key que ya comprobo que existe el valor iterado
            }

        }

        return $objeto;

    }

    //Sincroniza el objeto en memoria con los cambios realizados por el suario
    public function sincronizar($args = []) {

        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }

    }
}
