 <?php
require 'includes/funciones.php'; 
incluirTemplate('header'); 
?>

    <main class="seccion contenedor contenido-centrado">
        <h1>Casa en Venta frente al Bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpeg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imageb propiedad">
        </picture>
        <div class="resumen-propiedad">
            <p class="precio">
                $3.000.000
            </p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" class="icono" alt="icono wc" loading='lazy'>
                    <p>3</p>
                </li>
                <li>
                    <img src="build/img/icono_estacionamiento.svg" class="icono" alt="icono icono_estacionamiento"
                        loading='lazy'>
                    <p>3</p>
                </li>
                <li>
                    <img src="build/img/icono_dormitorio.svg" class="icono" alt="icono dormitorio" loading='lazy'>
                    <p>4</p>
                </li>
            </ul>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime illum laboriosam inventore blanditiis
                nam ullam dolorum dolores laborum expedita est. Vero soluta voluptas minima harum neque repellat
                pariatur deserunt! Ut. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae illum ab,
                distinctio numquam delectus fugit facere perspiciatis tempore. Deleniti quae adipisci aliquid impedit
                animi, corporis odio iste recusandae tenetur ex. Lorem ipsum dolor sit, amet consectetur adipisicing
                elit. Libero quos, consequuntur reprehenderit tempore iure accusamus voluptates quam odit rem quo fuga
                laudantium. Quae quia, corrupti recusandae ipsum rem tempore deserunt!
            </p>
        </div>

        </div>


    </main>
    <!--cierre seccion anuncios-->



   <?php
incluirTemplate('footer');
?>;




 