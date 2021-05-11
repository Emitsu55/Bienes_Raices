<?php

//Importar la conexion
$db = conectarDB();

//Consultar
$query = "SELECT * FROM propiedades LIMIT ${limite};";

//Obtener resultado
$resultado = mysqli_query($db, $query);


?>



<div class="contenedor-anuncios">

<?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">
            <img loading="lazy" src="<?php echo 'imagenes/' . $propiedad['imagen'] ?>" alt="anuncio">
        <div class="contenido-anuncio">

            <h3>
            <?php echo $propiedad['titulo']; ?>
            </h3>
            
            <p>
            <?php echo $propiedad['descripcion']; ?>
            </p>
            
            <p class="precio">
            <?php echo '$' . $propiedad['precio']; ?>
            </p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img src="/build/img/icono_wc.svg" class="icono" alt="icono wc" loading='lazy'>
                    <p>
                    <?php echo $propiedad['WC']; ?>
                    </p>
                </li>
                <li>
                    <img src="/build/img/icono_estacionamiento.svg" class="icono" alt="icono icono_estacionamiento" loading='lazy'>
                    <p>
                    <?php echo $propiedad['estacionamiento']; ?>
                    </p>
                </li>
                <li>
                    <img src="/build/img/icono_dormitorio.svg" class="icono" alt="icono dormitorio" loading='lazy'>
                    <p>
                    <?php echo $propiedad['habitaciones']; ?>
                    </p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="btn-amarillo-block">Ver Propiedad</a>
        </div>

    </div>
<?php endwhile; ?>

</div>
<!--Cierre contenedor anuncios-->


<?php 
//cerrar la conexion
mysqli_close($db);

?>