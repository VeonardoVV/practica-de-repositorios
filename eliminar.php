<?php
include "conexion.php";

// Verificar si se envió el formulario de eliminación
if (isset($_POST['eliminar'])) {
    $id_proveedor = $_POST['id_proveedor'];

    try {
        $sql = "DELETE FROM proveedor WHERE id_proveedor = :id_proveedor";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_proveedor' => $id_proveedor]);
        $mensaje = "Proveedor eliminado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error al eliminar el proveedor: " . $e->getMessage();
    }
}

// Obtener todos los proveedores
try {
    $sql = "SELECT * FROM proveedor";
    $stmt = $pdo->query($sql);
    $proveedores = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener proveedores: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Proveedores</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
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
    <h2>Eliminar Proveedores</h2>

    <?php if (!empty($mensaje)) : ?>
        <div class="mensaje"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Razón Social</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($proveedores as $proveedor) : ?>
        <tr>
            <form method="post" action="eliminar.php" onsubmit="return confirm('¿Estás seguro de eliminar este proveedor?');">
                <td><?php echo $proveedor['id_proveedor']; ?></td>
                <td><?php echo htmlspecialchars($proveedor['razonsocial']); ?></td>
                <td><?php echo htmlspecialchars($proveedor['direccion']); ?></td>
                <td><?php echo htmlspecialchars($proveedor['telefono']); ?></td>
                <td>
                    <input type="hidden" name="id_proveedor" value="<?php echo $proveedor['id_proveedor']; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>