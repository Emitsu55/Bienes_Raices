 <?php
require 'includes/app.php'; 
incluirTemplate('header'); 
?>

    <main class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>
        <?php
        $limite = 10;
        include 'includes/templates/anuncios.php';
        ?>
    </main><!--cierre seccion anuncios-->



<?php
incluirTemplate('footer');
?>;




 




 