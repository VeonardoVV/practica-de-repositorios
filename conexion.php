<?php

$host = "localhost";
$dbname = "base_datos";
$user = "root";
$password = "";

try {

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_PERSISTENT => false
    ];

    $pdo = new PDO($dsn, $user, $password, $options);

    echo "Conexión exitosa";

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

?>