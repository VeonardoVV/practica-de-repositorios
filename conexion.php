<?php

$host = "localhost";
$dbname = "base_datos";
$user = "root";
$password = "";

// Crear conexión
$conexion = mysqli_connect($host, $user, $password, $dbname);

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Opcional: configurar charset
mysqli_set_charset($conexion, "utf8");

echo "Conexión exitosa";

?>