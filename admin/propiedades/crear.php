<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();


$propiedad = new Propiedad;

//consultar para obtener los vendedores

$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);


//Array con mensajes de error

$errores = Propiedad::getErrores();

//Ejecutar el codigo despues del envio de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Crear la nueva instancia    
    $propiedad = new Propiedad($_POST['propiedad']);

    //Generar nombre unico para la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear la imagen
    //Realizar un resize a la imagen con intervention image
    
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImage($nombreImagen);
    }

    //Validacion    
    $errores = $propiedad->validar();

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

        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" class="btn btn-verde" value="Crear Propiedad">

    </form>

    <a href="/admin/index.php" class="btn btn-verde">Volver</a>
</main>

<?php

incluirTemplate('footer');

?>