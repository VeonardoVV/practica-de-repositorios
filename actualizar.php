<?php
include "conexion.php";

// Verificar si se envió el formulario de actualización
if (isset($_POST['actualizar'])) {
    $id_cliente = $_POST['id_cliente'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    try {
        $sql = "UPDATE clientes 
                SET nombres = :nombres, apellidos = :apellidos, direccion = :direccion, telefono = :telefono
                WHERE id_cliente = :id_cliente";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombres' => $nombres,
            ':apellidos' => $apellidos,
            ':direccion' => $direccion,
            ':telefono' => $telefono,
            ':id_cliente' => $id_cliente
        ]);
        $mensaje = "Cliente actualizado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error al actualizar el cliente: " . $e->getMessage();
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
    <title>Actualizar Clientes</title>
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
    <h2>Actualizar Clientes</h2>

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
            <form method="post" action="actualizar.php">
                <td><?php echo $cliente['id_cliente']; ?></td>
                <td><input type="text" name="nombres" value="<?php echo htmlspecialchars($cliente['nombres']); ?>"></td>
                <td><input type="text" name="apellidos" value="<?php echo htmlspecialchars($cliente['apellidos']); ?>"></td>
                <td><input type="text" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion']); ?>"></td>
                <td><input type="text" name="telefono" value="<?php echo htmlspecialchars($cliente['telefono']); ?>"></td>
                <td>
                    <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">
                    <input type="submit" name="actualizar" value="Actualizar">
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>