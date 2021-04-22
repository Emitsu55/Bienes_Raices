<?php


$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT); //Valida que la variable sea un entero

if (!$id) {
    header('Location: /admin');
}



//Base de datos

require '../../includes/config/database.php';
$db = conectarDB();

//Obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);


//consultar para obtener los vendedores

$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);


//Array con mensajes de error

$errores = [];

//Iniciar las variables
$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['WC'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedorId'];
$imagen = $propiedad['imagen'];


//Ejecutar el codigo despues del envio de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    //Almacenando datos del formulario en variables
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);  //mysqli_real** esta funcion impide que se ingresen comando de sql al formulario y da seguridad al formulario
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['baños']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamientos']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    //Asignar files a una variable
    $imagen = $_FILES['imagen'];
    var_dump($imagen['name']);


    if (!$titulo) {
        $errores[] = '*Debes añadir un titulo';
    }
    if (!$precio) {
        $errores[] = '*Debes añadir el precio';
    }
    if (strlen($descripcion) < 30) {
        $errores[] = '*La descripción es obligatoria y debe tener al menos 30 caracteres';
    }
    if (!$habitaciones) {
        $errores[] = '*Debes añadir el número de habitaciones';
    }
    if (!$wc) {
        $errores[] = '*Debes añadir el número de baños';
    }
    if (!$estacionamiento) {
        $errores[] = '*Debes añadir el número de estacionamientos';
    }
    if (!$vendedorId) {
        $errores[] = '*Elige un vendedor';
    }

    //validar maximo tamaño imagen

    $medida = 5000 * 100; //transformar de bytes a kilobytes

    if ($imagen['size'] > $medida) {
        $errores[] = '*La imagen no debe superar los 5Mb';
    }

    //Revisar que el Array de errores este vacio

    if (empty($errores)) {

        //crear carpetas
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);  //Crea la carpeta
        }

        $nombreImagen = '';

        //Subida de archivos

        if ($imagen['name']) {

            //Eliminar imagen previa }
            unlink($carpetaImagenes . $propiedad['imagen']);
            
            // //Generar nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            // //Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad['imagen'];
        }




        //insertar a la base de datos

        $query = "UPDATE propiedades SET titulo = '${titulo}', precio = ${precio}, imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, WC = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE  id = ${id};";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header('Location: /admin?resultado=2');  //query string
        }
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>

    <?php
    if (empty($errores) == false) { ?>
        <div class="alerta error">
            <?php echo '*Falta completar algunos campos'; ?>
        </div>
    <?php
    }
    ?>


    <form class="formulario" method="POST" enctype="multipart/form-data">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input value="<?php echo $titulo; ?>" id="titulo" name="titulo" type="text" placeholder="Titulo Propiedad">

            <label for="precio">Precio:</label>
            <input value="<?php echo $precio; ?>" id="precio" name="precio" type="number" placeholder="Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input id="imagen" name="imagen" type="file" accept="image/jpeg, image/png">

            <img src="/imagenes/<?php echo $imagen; ?>" class="imagen-small" alt="Imagen propiedad">

            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>

            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input value="<?php echo $habitaciones; ?>" id="habitaciones" name="habitaciones" type="number" placeholder="Número Habitaciones" min="1" max="9">

            <label for="baños">Baños:</label>
            <input value="<?php echo $wc; ?>" id="baños" name="baños" type="number" placeholder="Número Baños" min="1" max="9">

            <label for="estacionamientos">Estacionamientos:</label>
            <input value="<?php echo $estacionamiento; ?>" id="estacionamientos" name="estacionamientos" type="number" placeholder="Número Estacionamientos" min="1" max="9">

        </fieldset>

        <fieldset>

            <legend>Vendedor</legend>

            <select name="vendedor">

                <option value="">--Selecionar Vendedor--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId == $vendedor['id'] ? 'selected' : '';  ?> value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido']; ?></option>

                <?php endwhile; ?>

            </select>

        </fieldset>
        <?php foreach ($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <input type="submit" class="btn btn-verde" value="Actualizar Propiedad">

    </form>

    <a href="/admin/index.php" class="btn btn-verde">Volver</a>
</main>

<?php

incluirTemplate('footer');

?>