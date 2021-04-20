<?php

$resultado = $_GET['resultado'] ?? null; //el ?? le asigna nulo en caso de no existir 

require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
<h1>Administrador de Bienes Raices</h1>

<?php if(intval($resultado) === 1): ?>
    <p class="alerta success">¡Registro Exitoso!</p>
<?php endif; ?>

<a href="/admin/propiedades/crear.php" class="btn btn-verde">Nueva Propiedad</a>
<a href="/admin/propiedades/borrar.php" class="btn btn-verde">Borrar Propiedad</a>
<a href="/admin/propiedades/actualizar.php" class="btn btn-verde">Actualizar</a>
</main>

<?php

incluirTemplate('footer');

?>