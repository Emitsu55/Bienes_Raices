<?php

use App\Vendedor;

require '../../includes/app.php';

estaAutenticado();

//Validar url por id válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT); //Valida que la variable sea un entero

if (!$id) {
    header('Location: /admin');
}

//obtener los datos de la propiedad
$vendedor = Vendedor::find($id);

//Array con mensajes de error

$errores = Vendedor::getErrores();

//Iniciar las variables
$nombre = $vendedor->nombre;
$apellido = $vendedor->apellido;
$telefono = $vendedor->telefono;


//Ejecutar el codigo despues del envio de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    //Asignar los atributos
    $args = $_POST['vendedor'];

    $vendedor->sincronizar($args);

    //Validacion
    $errores = $vendedor->validar();


    

    if (empty($errores)) {

        //insertar a la base de datos
        $vendedor->guardar();
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

        <?php include  '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" class="btn btn-verde" value="Actualizar Vendedor">

    </form>

    <a href="/admin/index.php" class="btn btn-verde">Volver</a>
</main>

<?php

incluirTemplate('footer');

?>