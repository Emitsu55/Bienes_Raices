 <?php
require 'includes/funciones.php'; 
incluirTemplate('header'); 
?>

    <main class="contenedor">
        <h1>Conoce Sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Imagen nosotros" loading="lazy">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>25 Años de Experiencia</blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus illo iusto rem neque veritatis
                    consequuntur atque nostrum animi facere harum explicabo, inventore culpa laboriosam autem
                    reprehenderit amet dolor porro et?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio sequi delectus rerum voluptatem amet
                    distinctio minus id, quas deserunt. Ut sapiente veniam, minima commodi nostrum explicabo optio
                    repellat ad dolor?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae laborum incidunt earum sapiente
                    perspiciatis unde maxime ad dolorum, inventore ipsa hic voluptatum aperiam. Qui modi, natus
                    voluptatibus tenetur doloribus omnis!</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Más Sobre Nosotros</h2>
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
    </section>



   <?php
incluirTemplate('footer');
?>;




 