<?php
include "conexion.php";

// Verificar si se envió el formulario de eliminación
if (isset($_POST['eliminar'])) {
    $id_categoria = $_POST['id_categoria'];

    try {
        $sql = "DELETE FROM categoria WHERE id_categoria = :id_categoria";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_categoria' => $id_categoria]);
        $mensaje = "Categoría eliminada correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error al eliminar la categoría: " . $e->getMessage();
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
    <title>Eliminar Categorías</title>
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
        input[type="submit"] {
            padding: 5px 10px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: darkred;
        }
        .mensaje {
            margin-bottom: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <h2>Eliminar Categorías</h2>

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
            <form method="post" action="eliminar.php" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                <td><?php echo $categoria['id_categoria']; ?></td>
                <td><?php echo htmlspecialchars($categoria['descripcion']); ?></td>
                <td>
                    <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>