<?php
require '../includes/app.php';
estaAutenticado();

use App\Propiedad;
use App\Vendedor;

//Implementar metodo para obtener propiedades utilizando active record
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

//Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null; //el ?? le asigna nulo en caso de no existir 

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {

        $tipo = $_POST['tipo'];

        if(validarTipoContenido($tipo)){
            
            if($_POST['tipo'] === 'propiedad') {
                //traer el objeto completo
                $propiedad = Propiedad::find($id);
        
                //Eliminar la propiedad
                $propiedad->eliminar();
                
            } else if($_POST['tipo'] === 'vendedor') {
                //traer el objeto completo
                $vendedor = Vendedor::find($id);
        
                //Eliminar el vendedor
                $vendedor->eliminar();
                
            }
        }

    }

}





//incluye un template
incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta success">¡Registro Creado Exitosamente!</p>
    <?php elseif(intval($resultado) === 2) : ?>
    <p class="alerta success">¡Registro Actualizado!</p>
    <?php elseif(intval($resultado) === 3) : ?>
    <p class="alerta success">¡Registro Eliminado!</p>
    <?php endif; ?>

    <h2>Propiedades</h2>

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
            
        <?php foreach ($propiedades as $propiedad): ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td><img src="<?php echo "/imagenes/" . $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                <td><?php echo $propiedad->precio; ?></td>
                <td>
                    <form method="POST" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                    <input type="hidden" name="tipo" value="propiedad">
                    <input type="submit" class="btn-rojo-block" value="Eliminar Registro">
                    </form>
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="btn-verde-block">Actualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>    
        </tbody>
    </table>
    <a href="/admin/propiedades/crear.php" class="btn btn-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody><!-- 4- Mostrar los resultados-->
            
        <?php foreach ($vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td>
                    <form method="POST" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                    <input type="hidden" name="tipo" value="vendedor">
                    <input type="submit" class="btn-rojo-block" value="Eliminar">
                    </form>
                    <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="btn-verde-block">Actualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>    
        </tbody>
    </table>
    <a href="/admin/vendedores/crear.php" class="btn btn-verde">Nuevo Vendedor</a>

</main>

<?php

// 5- Cerrar la conexion
mysqli_close($db);

incluirTemplate('footer');


?>