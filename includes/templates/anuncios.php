<?php

use App\Propiedad;

if($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
    
    $propiedades = Propiedad::get(10);
} else {
    $propiedades = Propiedad::get(3);
    
}


?>



<div class="contenedor-anuncios">

<?php foreach($propiedades as $propiedad): ?>
    <div class="anuncio">
            <img loading="lazy" src="<?php echo 'imagenes/' . $propiedad->imagen; ?>" alt="anuncio">
        <div class="contenido-anuncio">

            <h3>
            <?php echo $propiedad->titulo; ?>
            </h3>
            
            <p>
            <?php echo $propiedad->descripcion; ?>
            </p>
            
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
                    <img src="/build/img/icono_estacionamiento.svg" class="icono" alt="icono icono_estacionamiento" loading='lazy'>
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
            <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="btn-amarillo-block">Ver Propiedad</a>
        </div>

    </div>
<?php endforeach; ?>

</div>
<!--Cierre contenedor anuncios-->

