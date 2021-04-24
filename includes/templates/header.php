<?php

if(!isset($_SESSION)) {
    session_start();
    
}

$auth = $_SESSION['login'] ?? null; // el "??" refiere a que si no existe es nulo


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>Bienes Raices</title>
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : '' ; ?>"> <!--operador ternario (funciona como un if)-->
        <div class="contenedor contenido-header">
            <div class="barra">

                <a href="index.php"><img src="/build/img/logo.svg" alt="Logo Bienes Raices"></a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="btn-dark-mode" src="/build/img/dark-mode.svg" alt="">
                    <nav class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if($auth) : ?>
                        <a href="/cerrar_sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div><!--Cierre barra-->

            <?php
            if($inicio) {
                echo '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>';
            }
            ?>
        </div>
    </header>
    <!--Cierre header-->


