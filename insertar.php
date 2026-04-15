<?php
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_proveedor = $_POST['id_proveedor'] ?? '';
    $razonsocial  = $_POST['razonsocial'] ?? '';
    $direccion    = $_POST['direccion'] ?? '';
    $telefono     = $_POST['telefono'] ?? '';

    try {
        $sql = "INSERT INTO proveedor (id_proveedor, razonsocial, direccion, telefono)
                VALUES (:id_proveedor, :razonsocial, :direccion, :telefono)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_proveedor', $id_proveedor, PDO::PARAM_INT);
        $stmt->bindParam(':razonsocial', $razonsocial, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->execute();

        echo "<p style='color:green;'>Proveedor insertado correctamente con ID: " . $id_proveedor . "</p>";
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error al insertar: " . $e->getMessage() . "</p>";
    }
}
?>

<h2>Insertar nuevo proveedor</h2>
<form method="post" action="">
    <label for="id_proveedor">ID Proveedor:</label><br>
    <input type="number" name="id_proveedor" id="id_proveedor" required><br><br>

    <label for="razonsocial">Razón Social:</label><br>
    <input type="text" name="razonsocial" id="razonsocial" required><br><br>

    <label for="direccion">Dirección:</label><br>
    <input type="text" name="direccion" id="direccion" required><br><br>

    <label for="telefono">Teléfono:</label><br>
    <input type="text" name="telefono" id="telefono" required><br><br>

    <input type="submit" value="Insertar">
</form>