<?php
include "conexion.php";

// Verificar si se envió el formulario de actualización
if (isset($_POST['actualizar'])) {
    $id_proveedor = $_POST['id_proveedor'];
    $razonsocial = $_POST['razonsocial'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    try {
        $sql = "UPDATE proveedor 
                SET razonsocial = :razonsocial, direccion = :direccion, telefono = :telefono
                WHERE id_proveedor = :id_proveedor";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':razonsocial' => $razonsocial,
            ':direccion' => $direccion,
            ':telefono' => $telefono,
            ':id_proveedor' => $id_proveedor
        ]);
        $mensaje = "Proveedor actualizado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error al actualizar el proveedor: " . $e->getMessage();
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
    <title>Actualizar Proveedores</title>
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
        input[type="text"] {
            width: 95%;
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
    <h2>Actualizar Proveedores</h2>

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
            <form method="post" action="actualizar.php">
                <td><?php echo $proveedor['id_proveedor']; ?></td>
                <td>
                    <input type="text" name="razonsocial" value="<?php echo htmlspecialchars($proveedor['razonsocial']); ?>">
                </td>
                <td>
                    <input type="text" name="direccion" value="<?php echo htmlspecialchars($proveedor['direccion']); ?>">
                </td>
                <td>
                    <input type="text" name="telefono" value="<?php echo htmlspecialchars($proveedor['telefono']); ?>">
                </td>
                <td>
                    <input type="hidden" name="id_proveedor" value="<?php echo $proveedor['id_proveedor']; ?>">
                    <input type="submit" name="actualizar" value="Actualizar">
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>