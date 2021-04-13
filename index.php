<?php
require 'includes/funciones.php'; 
incluirTemplate('header', $inicio = true); 
?>

    <main class="contenedor">
        <h1>Más sobre nosotros</h1>
        <div class="contenedor iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono Seguridad" loading='lazy'>
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ratione dolore a, inventore
                    quaerat quas aliquam praesentium expedita vel similique ducimus! Hic possimus odio nam. Asperiores
                    corporis eum impedit labore?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono precio" loading='lazy'>
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ratione dolore a, inventore
                    quaerat quas aliquam praesentium expedita vel similique ducimus! Hic possimus odio nam. Asperiores
                    corporis eum impedit labore?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono a tiempo" loading='lazy'>
                <h3>A tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ratione dolore a, inventore
                    quaerat quas aliquam praesentium expedita vel similique ducimus! Hic possimus odio nam. Asperiores
                    corporis eum impedit labore?</p>
            </div>
        </div>
    </main><!--Cierre del Main-->

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>
        <div class="contenedor-anuncios">
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio1.webp" type="image/webp">
                    <source srcset="build/img/anuncio1.jpeg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio1.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">

                    <h3>Casa de Lujo en el Lago</h3>
                    <p>Casa en el lago con excelente vista, acabados de lujo a un excelente precio.</p>
                    <p class="precio">
                        $3.000.000
                    </p>
                     
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" class="icono" alt="icono wc" loading='lazy'>
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" class="icono"
                                alt="icono icono_estacionamiento" loading='lazy'>
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" class="icono" alt="icono dormitorio"
                                loading='lazy'>
                            <p>4</p>
                        </li>
                    </ul>
                    <a href="anuncio.php" class="btn-amarillo-block">Ver Propiedad</a>
                </div>

            </div>
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio2.webp" type="image/webp">
                    <source srcset="build/img/anuncio2.jpeg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio3.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">

                    <h3>Casa Terminados de Lujo</h3>
                    <p>Casa en el lago con excelente vista, acabados de lujo
                        a un excelente precio.
                    </p>
                    <p class="precio">
                        $3.000.000
                    </p>
                     
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" class="icono" alt="icono wc" loading='lazy'>
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" class="icono"
                                alt="icono icono_estacionamiento" loading='lazy'>
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" class="icono" alt="icono dormitorio"
                                loading='lazy'>
                            <p>4</p>
                        </li>
                    </ul>
                    <a href="anuncio.php" class="btn-amarillo-block">Ver Propiedad</a>
                </div>

            </div>
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio3.webp" type="image/webp">
                    <source srcset="build/img/anuncio3.jpeg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio3.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">

                    <h3>Casa con Alberca</h3>
                    <p>
                        Casa con alberca de lujo a excelente precio.
                    </p>
                    <p class="precio">
                        $3.000.000
                    </p>
                     
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" class="icono" alt="icono wc" loading='lazy'>
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" class="icono"
                                alt="icono icono_estacionamiento" loading='lazy'>
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" class="icono" alt="icono dormitorio"
                                loading='lazy'>
                            <p>3</p>
                        </li>
                    </ul>
                    <a href="anuncios.php" class="btn-amarillo-block">Ver Propiedad</a>
                </div>

            </div>
        </div><!--Cierre contenedor anuncios-->
        <div class="alinear-derecha">
            <a href="anuncios.php" class="btn-verde"> Ver Todas</a>
        </div>
    </section><!--cierre seccion anuncios-->

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá 
            en contacto contigo a la brevedad</p>
        <a class="btn-amarillo" href="contacto.php">
            Contáctanos
        </a>

    </section><!--Cierre seccion contacto-->

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h2>Nuestro Blog</h2>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpeg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>

                <p>Escrito el: <span>20/10/2021</span> por <span>Admin</span></p>
                <p>Consejos para construir una terraza en el techo de tu casa con 
                    los mejores materiales y ahorrando dinero</p>

                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpeg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guia para la decoración de tu hogar</h4>

                <p>Escrito el: <span>20/10/2021</span> por <span>Admin</span></p>
                <p>Maximiza el espacio en tu hogar con esta guia, aprende a 
                    combinar muebles y colores para darle vida a tu espacio</p>

                    </a>
                </div>
            </article>
        </section>
        <section class="testimoniales">
            <h2>Testimoniales</h2>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente 
                    forma, muy buena atención y la casa que 
                    me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>-Emiliano Muñoz</p>
            </div>
        </section>

    </div><!--Cierre seccion inferior-->

<?php
incluirTemplate('footer');
?>;




 