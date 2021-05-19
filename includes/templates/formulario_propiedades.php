<fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input value="<?php echo s($propiedad->titulo); ?>" id="titulo" name="propiedad[titulo]" type="text" placeholder="Titulo Propiedad">

            <label for="precio">Precio:</label>
            <input value="<?php echo s($propiedad->precio); ?>" id="precio" name="propiedad[precio]" type="number" placeholder="Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input id="imagen" name="propiedad[imagen]" type="file" accept="image/jpeg, image/png">

            <?php if($propiedad->imagen) { ?>
            <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small" alt="Imagen propiedad">
            <?php } ?>

            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>

        </fieldset>

        <fieldset>

            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input value="<?php echo s($propiedad->habitaciones); ?>" id="habitaciones" name="propiedad[habitaciones]" type="number" placeholder="Número Habitaciones" min="1" max="9">

            <label for="wc">Baños:</label>
            <input value="<?php echo s($propiedad->wc); ?>" id="wc" name="propiedad[wc]" type="number" placeholder="Número Baños" min="1" max="9">

            <label for="estacionamiento">Estacionamientos:</label>
            <input value="<?php echo s($propiedad->estacionamiento); ?>" id="estacionamiento" name="propiedad[estacionamiento]" type="number" placeholder="Número Estacionamientos" min="1" max="9">

        </fieldset>

        <fieldset>

            <legend>Vendedor</legend>

            <label for="vendedor">Selecciona el vendedor</label>
            <select name="propiedad[vendedorId]" id="vendedor">
            <option value="" selected disabled>--Seleccionar Vendedor--</option>
            <?php foreach( $vendedores as $vendedor){ ?>
                <option
                <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected': ''; ?> 
                value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></option>
            <?php
            }?>
            </select>

        </fieldset>
        
        <?php foreach ($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>