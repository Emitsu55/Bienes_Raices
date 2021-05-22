<?php
require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();


$vendedor = new Vendedor();

//Array con mensajes de error

$errores = Vendedor::getErrores();

//Ejecutar el codigo despues del envio de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Crear la nueva instancia    
    $vendedor = new Vendedor($_POST['vendedor']);
    
    //Validacion    
    $errores = $vendedor->validar();

    //Revisar que el Array de errores este vacio

    if (empty($errores)) {

        //insertar a la base de datos 
        $resultado = $vendedor->guardar();
        
        //Mensaje de exito
        if ($resultado) {
            header('Location: /admin?resultado=1');  //query string
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Registrar un Vendedor</h1>

    <?php
    if (empty($errores) == false) { ?>
        <div class="alerta error">
            <?php echo '*Falta completar algunos campos'; ?>
        </div>
    <?php
    }
    ?>


    <form action="/admin/vendedores/crear.php" class="formulario" method="POST">

        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" class="btn btn-verde" value="Crear Vendedor">

    </form>

    <a href="/admin/index.php" class="btn btn-verde">Volver</a>
</main>

<?php

incluirTemplate('footer');

?>