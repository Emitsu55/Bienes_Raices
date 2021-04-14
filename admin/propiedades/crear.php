<?php

//Base de datos

require '../../includes/config/database.php';
$db = conectarDB();

//Array con mensajes de error

$errores = [];

//Iniciar las variables
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';


//Ejecutar el codigo despues del envio de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    
    //Almacenando datos del formulario en variables
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['baños'];
    $estacionamiento = $_POST['estacionamientos'];
    $vendedorId = $_POST['vendedor'];

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


    //Revisar que el Array de errores este vacio

    if (empty($errores)) {

        //insertar a la base de datos

        $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId'); ";
        //En la variable $query cree el comando de mysql para agregar el contenido del formulario a la base de datos
        echo ($query);

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo 'insertado correctamente';
        }
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Registrar una Propiedad</h1>

    <?php
    if(empty($errores === false)) { ?>
        <div class="alerta error">
        <?php echo '*Falta completar algunos campos'; ?>
        </div>
        <?php
    }
    ?>


    <form action="/admin/propiedades/crear.php" class="formulario" method="POST">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input value="<?php echo $titulo ; ?>" id="titulo" name="titulo" type="text" placeholder="Titulo Propiedad">

            <label for="precio">Precio:</label>
            <input value="<?php echo $precio ; ?>" id="precio" name="precio" type="number" placeholder="Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input id="imagen" name="imagen" type="file" accept="image/jpeg, image/png">

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

                <option value="" selected>--Selecionar Vendedor--</option>
                <option value="1">Emiliano</option>
                <option value="2">Laura</option>

            </select>

        </fieldset>
    <?php foreach($errores as $error):?>
    
    <div class="alerta error">
      <?php echo $error; ?>
    </div>

    <?php endforeach; ?>

        <input type="submit" class="btn btn-verde" value="Crear Propiedad">

    </form>

    <a href="/admin/index.php" class="btn btn-verde">Volver</a>
</main>

<?php

incluirTemplate('footer');

?>