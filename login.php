<?php

//Conectar a la base de datos
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

//autenticar el usuario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //Definiendo las variables
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);
    
    //Definiendo errores
    
    if(!$email) {
        $errores[] = "*Debe colocar su Email";
    }
    
    if(!$password) {
        $errores[] = "*Debe colocar su contraseña";
    }
    
    if(empty($errores)){
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}';";
        $resultado = mysqli_query($db, $query);

        if($resultado->num_rows) {
            //Revisar el password
            $usuario = mysqli_fetch_assoc($resultado);

            //Autenticar
            $auth = password_verify($password, $usuario['password']);

            if($auth) {
                //El usuario esta autenticado
                session_start();

                //Llenar el arreglo de la session
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: /admin');

            } else {
                $errores[] = '*Contraseña incorrecta'; 
            }
        } else {
            $errores[] = "*El usuario no existe";
        }
    }
    
}

//incluye el header
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
<h1>Iniciar Sesión</h1>
<?php foreach($errores as $error): ?>

<p class="alerta error txt-center">
<?php echo $error; ?>
</p>

<?php endforeach; ?>
<form method="POST" class="formulario contenido-centrado loginForm">

<fieldset>

<legend>Autenticación</legend>

<label for="email">E-Mail:</label>
<input id="email" name="email" type="email" placeholder="Tu E-Mail" >

<label for="password">Contraseña:</label>
<input id="password" name="password" type="password" placeholder="Tu Contraseña" require>

</fieldset>

<input type="submit" class="btn btn-verde" value="Ingresar">

</form>
</main>

<?php

incluirTemplate('footer');

?>