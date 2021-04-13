 <?php
require 'includes/funciones.php'; 
incluirTemplate('header'); 
?>



    <main class="contenedor">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>
        <h2>Llene el Formulario de Contacto</h2>
        <form action="" class="formulario">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" placeholder="Tu Nombre...">
               
                <label for="email">Email</label>
                <input id="email" type="email" placeholder="Tu Email...">
               
                <label for="telefono">Teléfono</label>
                <input type="phone" id="telefono" placeholder="Tu Telefono...">
               
                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea>
            
            </fieldset>
            <fieldset>
                <legend>Información Sobre la Propiedad</legend>
                
                <label for="vende-compra">Vende o Compra:</label>
                <select name="vende-compra" id="vende-compra">
                    <option value="" disabled selected >--Seleccione--</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>
                
                    <label for="precio">Precio o Presupuesto</label>
                    <input type="number" id="precio">
            
            </fieldset>
            <fieldset>
                <legend>Información sobre la Propiedad</legend>
            
                <p>Como desea ser Contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">TELÉFONO</label>
                    <input type="radio" id="contactar-telefono" name="contacto" value="Teléfono">
                
                    <label for="contactar-email">E-MAIL</label>
                    <input type="radio" id="contactar-email" name="contacto" value="Email">
                
                </div>
               
                <p>Si eligió teléfono, elija la fecha y la hora</p>
            
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">
            
                <label for="hora">Hora</label>
                <input type="time" id="hora">
            
            </fieldset>
            
            <input type="submit" class="btn-verde">
        
        </form>
    </main>



<?php
incluirTemplate('footer');
?>;




 
