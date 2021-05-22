<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';

estaAutenticado();

//Validar url por id válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT); //Valida que la variable sea un entero

if (!$id) {
    header('Location: /admin');
}

//obtener los datos de la propiedad
$propiedad = Propiedad::find($id);

//consulta para obtener los vendedores
$vendedores = Vendedor::all();

//Array con mensajes de error

$errores = Propiedad::getErrores();

//Iniciar las variables
$titulo = $propiedad->titulo;
$precio = $propiedad->precio;
$descripcion = $propiedad->descripcion;
$habitaciones = $propiedad->habitaciones;
$wc = $propiedad->wc;
$estacionamiento = $propiedad->estacionamiento;
$vendedorId = $propiedad->vendedorId;
$imagen = $propiedad->imagen;


//Ejecutar el codigo despues del envio de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    //Asignar los atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    //Validacion
    $errores = $propiedad->validar();


    if ($_FILES['propiedad']['tmp_name']['imagen']) {

        //Generar nombre unico para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        //Modificar la imagen con intervention image
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        //Asignarle el nombre a la imagen
        $propiedad->setImage($nombreImagen);
    }

    if (empty($errores)) {

        if (isset($image)) {
            //Subida de archivos
            //Guardar la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }

        //insertar a la base de datos
        $propiedad->guardar();
    }
}

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

        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" class="btn btn-verde" value="Actualizar Propiedad">

    </form>

    <a href="/admin/index.php" class="btn btn-verde">Volver</a>
</main>

<?php

incluirTemplate('footer');

?>