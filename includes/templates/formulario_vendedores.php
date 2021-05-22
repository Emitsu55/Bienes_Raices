<fieldset>
    <legend> Datos del Vendedor</legend>

    <label for="nombre">Nombre:</label>
    <input value="<?php echo $vendedor->nombre; ?>" type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del vendedor">

    <label for="apellido">Apellido:</label>
    <input value="<?php echo $vendedor->apellido; ?>" type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del vendedor">

    <label for="telefono">Teléfono:</label>
    <input value="<?php echo $vendedor->telefono; ?>" type="tel" id="telefono" name="vendedor[telefono]" placeholder="Teléfono del vendedor">

</fieldset>

<?php foreach ($errores as $error) : ?>

    <div class="alerta error">
        <?php echo $error; ?>
    </div>

<?php endforeach; ?>