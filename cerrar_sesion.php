<?php

session_start();

$_SESSION = [];

header('Location: /');

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';