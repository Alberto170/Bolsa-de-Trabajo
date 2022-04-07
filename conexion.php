<?php
$server = "127.0.0.1";
$user = "root";
$pass = "Password170!";
// $db = "controlescolar";
$db = "bolsaTrabajo";
$conexion = new mysqli($server, $user, $pass, $db);

// if($conexion -> connect_errno) {
//     die("La conexion ha fallado" . $conexion -> connect_errno);
// }else {
//     echo "Conectado";
// }
