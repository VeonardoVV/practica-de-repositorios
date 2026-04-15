<?php
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente  = $_POST['id_cliente'] ?? '';
    $nombres     = $_POST['nombres'] ?? '';
    $apellidos   = $_POST['apellidos'] ?? '';
    $direccion   = $_POST['direccion'] ?? '';
    $telefono    = $_POST['telefono'] ?? '';

    try {
        $sql = "INSERT INTO clientes (id_cliente, nombres, apellidos, direccion, telefono)
                VALUES (:id_cliente, :nombres, :apellidos, :direccion, :telefono)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombres', $nombres, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->execute();

        echo "<p style='color:green;'>Cliente insertado correctamente con ID: " . $id_cliente . "</p>";
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error al insertar: " . $e->getMessage() . "</p>";
    }
}
?>

<h2>Insertar nuevo cliente</h2>
<form method="post" action="">
    <label for="id_cliente">ID Cliente:</label><br>
    <input type="number" name="id_cliente" id="id_cliente" required><br><br>

    <label for="nombres">Nombres:</label><br>
    <input type="text" name="nombres" id="nombres" required><br><br>

    <label for="apellidos">Apellidos:</label><br>
    <input type="text" name="apellidos" id="apellidos" required><br><br>

    <label for="direccion">Dirección:</label><br>
    <input type="text" name="direccion" id="direccion" required><br><br>

    <label for="telefono">Teléfono:</label><br>
    <input type="text" name="telefono" id="telefono" required><br><br>

    <input type="submit" value="Insertar">
</form>