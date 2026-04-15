<?php
include "conexion.php";

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_categoria = $_POST['id_categoria'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    try {
        $sql = "INSERT INTO categoria (id_categoria, descripcion) VALUES (:id_categoria, :descripcion)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);

        $stmt->execute();

        echo "<p style='color:green;'>Categoría insertada correctamente.</p>";
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error al insertar: " . $e->getMessage() . "</p>";
    }
}
?>

<h2>Insertar nueva categoría</h2>
<form method="post" action="">
    <label for="id_categoria">ID Categoría:</label><br>
    <input type="number" name="id_categoria" id="id_categoria" required><br><br>

    <label for="descripcion">Descripción:</label><br>
    <input type="text" name="descripcion" id="descripcion" required><br><br>

    <input type="submit" value="Insertar">
</form>