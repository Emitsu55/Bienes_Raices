<?php

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

//Base de datos
$db = conectarDB();


//consultar para obtener los vendedores

$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);


//Array con mensajes de error

$errores = Propiedad::getErrores();


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

    //Crear la nueva instancia    
    $propiedad = new Propiedad($_POST);

    //Generar nombre unico para la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear la imagen
    //Realizar un resize a la imagen con intervention image
    if ($_FILES['imagen']['tmp_name']) {

        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $propiedad->setImage($nombreImagen);
    }

    //Validacion    
    $errores = $propiedad->validar();


    // //Almacenando datos del formulario en variables
    // $titulo = mysqli_real_escape_string($db, $_POST['titulo']);  //mysqli_real** esta funcion impide que se ingresen comando de sql al formulario y da seguridad al formulario
    // $precio = mysqli_real_escape_string($db, $_POST['precio']);
    // $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    // $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    // $wc = mysqli_real_escape_string($db, $_POST['baños']);
    // $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    // $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    // $creado = date('Y/m/d');

    //Revisar que el Array de errores este vacio

    if (empty($errores)) {

        
        //crear carpetas
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);  //Crea la carpeta
        }

        //Subida de archivos
        //Guardar la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        
        //insertar a la base de datos 
        $resultado = $propiedad->guardar();
        
        //Mensaje de exito
        if ($resultado) {
            header('Location: /admin?resultado=1');  //query string
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Registrar una Propiedad</h1>

    <?php
    if (empty($errores) == false) { ?>
        <div class="alerta error">
            <?php echo '*Falta completar algunos campos'; ?>
        </div>
    <?php
    }
    ?>


    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input value="<?php echo $titulo; ?>" id="titulo" name="titulo" type="text" placeholder="Titulo Propiedad">

            <label for="precio">Precio:</label>
            <input value="<?php echo $precio; ?>" id="precio" name="precio" type="number" placeholder="Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input id="imagen" name="imagen" type="file" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>

            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input value="<?php echo $habitaciones; ?>" id="habitaciones" name="habitaciones" type="number" placeholder="Número Habitaciones" min="1" max="9">

            <label for="wc">Baños:</label>
            <input value="<?php echo $wc; ?>" id="wc" name="wc" type="number" placeholder="Número Baños" min="1" max="9">

            <label for="estacionamiento">Estacionamientos:</label>
            <input value="<?php echo $estacionamiento; ?>" id="estacionamiento" name="estacionamiento" type="number" placeholder="Número Estacionamientos" min="1" max="9">

        </fieldset>

        <fieldset>

            <legend>Vendedor</legend>

            <select name="vendedorId">

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

        <input type="submit" class="btn btn-verde" value="Crear Propiedad">

    </form>

    <a href="/admin/index.php" class="btn btn-verde">Volver</a>
</main>

<?php

incluirTemplate('footer');

?>