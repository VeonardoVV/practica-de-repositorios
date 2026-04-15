<?php
include "conexion.php";

// Verificar si se envió el formulario de actualización
if (isset($_POST['actualizar'])) {
    $id_categoria = $_POST['id_categoria'];
    $descripcion = $_POST['descripcion'];

    try {
        $sql = "UPDATE categoria SET descripcion = :descripcion WHERE id_categoria = :id_categoria";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':descripcion' => $descripcion,
            ':id_categoria' => $id_categoria
        ]);
        $mensaje = "Categoría actualizada correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error al actualizar la categoría: " . $e->getMessage();
    }
}

// Obtener todas las categorías
try {
    $sql = "SELECT * FROM categoria";
    $stmt = $pdo->query($sql);
    $categorias = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener categorías: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Categorías</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        input[type="text"] {
            width: 90%;
        }
        input[type="submit"] {
            padding: 5px 10px;
        }
        .mensaje {
            margin-bottom: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <h2>Actualizar Categorías</h2>

    <?php if (!empty($mensaje)) : ?>
        <div class="mensaje"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($categorias as $categoria) : ?>
        <tr>
            <form method="post" action="actualizar.php">
                <td><?php echo $categoria['id_categoria']; ?></td>
                <td>
                    <input type="text" name="descripcion" value="<?php echo htmlspecialchars($categoria['descripcion']); ?>">
                </td>
                <td>
                    <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">
                    <input type="submit" name="actualizar" value="Actualizar">
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>