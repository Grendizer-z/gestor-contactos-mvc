<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home contactos</title>
</head>
<body>
    <?php
    if (empty($_SESSION['LOGGED_IN'])) {
        header('Location: ../');
        exit;
    }

    echo "<h1>Bienvenido, " . htmlspecialchars($_SESSION['usuario_nombre']) . "</h1>";
    echo "<a href='../contactos/create'>Crear Nuevo Contacto</a>";
    echo "<h2>Lista de Contactos</h2>";

    if (!empty($data['contacts'])){

        foreach ($data['contacts'] as $contacto) {
        echo "<p>Nombre: " . htmlspecialchars($contacto['nombre']) . "</p>";
        echo "<p>Teléfono: " . htmlspecialchars($contacto['telefono']) . "</p>";
        echo "<p>Email: " . htmlspecialchars($contacto['email']) . "</p>";
        echo "<a href='../contactos/edit/" . htmlspecialchars($contacto['id']) . "'>Editar</a> | ";
        echo "<a href='../contactos/delete/" . htmlspecialchars($contacto['id']) . "' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este contacto?');\">Eliminar</a>";
        echo "<hr>";
        }
    }
    
    ?>
    <a href="../usuarios/login">salir</a>
</body>
</html>