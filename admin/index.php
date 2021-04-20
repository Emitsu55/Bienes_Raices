<?php

// 1- importar la conexion 
require '../includes/config/database.php';
$db = conectarDB();

// 2- escribir el query
$query = "SELECT * FROM propiedades";

// 3- Consultar la BD
$resultadoConsulta = mysqli_query($db, $query);

//Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null; //el ?? le asigna nulo en caso de no existir 

//incluye un template
require '../includes/funciones.php';
incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta success">¡Registro Exitoso!</p>
    <?php endif; ?>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody><!-- 4- Mostrar los resultados-->
            
        <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr>
                <td><?php echo $propiedad['id']; ?></td>
                <td><?php echo $propiedad['titulo']; ?></td>
                <td><img src="<?php echo "/imagenes/" . $propiedad['imagen']; ?>" class="imagen-tabla" alt=""></td>
                <td><?php echo $propiedad['precio']; ?></td>
                <td>
                    <a href="/admin/propiedades/borrar.php" class="btn-rojo-block">Eliminar</a>
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="btn-verde-block">Actualizar</a>
                </td>
            </tr>
        <?php endwhile; ?>    
        </tbody>
    </table>

    <a href="/admin/propiedades/crear.php" class="btn btn-verde">Nueva Propiedad</a>
</main>

<?php

// 5- Cerrar la conexion
mysqli_close($db);

incluirTemplate('footer');


?>