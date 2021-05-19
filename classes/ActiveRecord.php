<?php

namespace App;

class ActiveRecord 
{

    //Base de Datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    //Errores 
    protected static $errores = [];




    //Definir la conexion a la BD
    public static function setDb($database)
    {
        Self::$db = $database;
    }



    public function guardar() {
        
        if(!is_null($this->id)) {
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

        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ( ' ";
        $query .= join("', '", array_values($atributos));
        $query .= " '); ";

        $resultado = self::$db->query($query);
        
        //Mensaje de exito
        if($resultado) {
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar() {
        //sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach($atributos as $key=>$value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores); //Une valores de un array en un string y los separa por una ','
        $query .= " WHERE  id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1;";

        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location: /admin?resultado=2');  //query string
        }
    }

    //eliminar un registro
    public function eliminar() {
        //crear query
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    //identificar y unir atributos de la DB
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
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
        if(!is_null($this->id)){   //isset revisa que exista y que ademas tenga un valor
            $this->borrarImagen();
        }
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Borrar imagen 
    public function borrarImagen() {
           //Comprobar si existe el archivo
           $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            
           if($existeArchivo) {
               unlink(CARPETA_IMAGENES . $this->imagen);
           }
        
    }

    //Validacion
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar() {

        static::$errores = [];
        return static::$errores;
    }


    //Listar todas las propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSql($query);

        
        return $resultado;

    }

    //Buscar un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSql(($query));

        return array_shift($resultado); //Array_shift devuelve la primer posicion de un arreglo
    }

    public static function consultarSql($query){
        //Consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //Liberar memoria
        $resultado->free();

        //Retornar los resultados
        return $array; 
    }

    protected static function crearObjeto($registro){

        $objeto = new static;

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
