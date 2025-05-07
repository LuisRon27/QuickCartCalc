<?php

$host = "sql203.infinityfree.com";
$user = "if0_38869918";
$password = "NFdzCLb4TQTMHI7";
$dbName = "if0_38869918_quickcartcalc";

// Crear una conexión
$conexion = new mysqli($host, $user, $password, $dbName);

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

?>