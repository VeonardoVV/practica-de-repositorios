<?php

include "conexion.php";

try {

    $sql = "SELECT id_cliente, nombres, apellidos, direccion, telefono FROM clientes";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Listado de clientes</h2>";

    echo "<table border='1'>";
    echo "<tr>
            <th>ID Cliente</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Teléfono</th>
          </tr>";

    foreach ($clientes as $cliente) {
        echo "<tr>";
        echo "<td>" . $cliente['id_cliente'] . "</td>";
        echo "<td>" . $cliente['nombres'] . "</td>";
        echo "<td>" . $cliente['apellidos'] . "</td>";
        echo "<td>" . $cliente['direccion'] . "</td>";
        echo "<td>" . $cliente['telefono'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
<!-- http://localhost/PracticaRepositorio/mostrar.php -->