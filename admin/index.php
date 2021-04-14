<?php

require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
<h1>Administrador de Bienes Raices</h1>

<a href="/admin/propiedades/crear.php" class="btn btn-verde">Nueva Propiedad</a>
<a href="/admin/propiedades/borrar.php" class="btn btn-verde">Borrar Propiedad</a>
<a href="/admin/propiedades/actualizar.php" class="btn btn-verde">Actualizar</a>
</main>

<?php

incluirTemplate('footer');

?>