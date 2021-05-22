 <?php
require 'includes/app.php';

 use App\Propiedad;

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: anuncios.php');
}

$propiedad = Propiedad::find($id);

//Importar conexion

incluirTemplate('header'); 
?>

    <main class="seccion contenedor contenido-centrado">
        <h1>
        <?php echo $propiedad->titulo; ?>
        </h1>
        
            <img loading="lazy" src="<?php echo 'imagenes/' . $propiedad->imagen; ?>" alt="imagen propiedad">
        
        <div class="resumen-propiedad">
            <p class="precio">
            <?php echo '$' . $propiedad->precio; ?>
            </p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img src="/build/img/icono_wc.svg" class="icono" alt="icono wc" loading='lazy'>
                    <p>
                    <?php echo $propiedad->wc; ?>
                    </p>
                </li>
                <li>
                    <img src="/build/img/icono_estacionamiento.svg" class="icono" alt="icono icono_estacionamiento"
                        loading='lazy'>
                    <p>
                    <?php echo $propiedad->estacionamiento; ?>
                    </p>
                </li>
                <li>
                    <img src="/build/img/icono_dormitorio.svg" class="icono" alt="icono dormitorio" loading='lazy'>
                    <p>
                    <?php echo $propiedad->habitaciones; ?>
                    </p>
                </li>
            </ul>
            <p>
            <?php echo $propiedad->descripcion; ?>
            </p>
        </div>

        </div>


    </main><!--cierre seccion anuncios-->

   <?php

incluirTemplate('footer');
?>;




 