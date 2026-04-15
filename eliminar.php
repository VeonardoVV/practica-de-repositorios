<?php
include "conexion.php";

// Verificar si se envió el formulario de eliminación
if (isset($_POST['eliminar'])) {
    $id_cliente = $_POST['id_cliente'];

    try {
        $sql = "DELETE FROM clientes WHERE id_cliente = :id_cliente";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_cliente' => $id_cliente]);
        $mensaje = "Cliente eliminado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error al eliminar el cliente: " . $e->getMessage();
    }
}

// Obtener todos los clientes
try {
    $sql = "SELECT * FROM clientes";
    $stmt = $pdo->query($sql);
    $clientes = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener clientes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Clientes</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
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
    <h2>Eliminar Clientes</h2>

    <?php if (!empty($mensaje)) : ?>
        <div class="mensaje"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($clientes as $cliente) : ?>
        <tr>
            <form method="post" action="eliminar.php" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
                <td><?php echo $cliente['id_cliente']; ?></td>
                <td><?php echo htmlspecialchars($cliente['nombres']); ?></td>
                <td><?php echo htmlspecialchars($cliente['apellidos']); ?></td>
                <td><?php echo htmlspecialchars($cliente['direccion']); ?></td>
                <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                <td>
                    <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>