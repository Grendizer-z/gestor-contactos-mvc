<?php
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Crear Contacto</title>
</head>
<body>
    <h1>Crear Nuevo Contacto</h1>
    <form action='/contactos/create' method='POST'>
        <input type='text' name='nombre' placeholder='Nombre' required>
        <input type='text' name='telefono' placeholder='Teléfono' required>
        <input type='email' name='email' placeholder='Email' required>
        <input type='submit' value='Crear Contacto'>
    </form>
    <a href='../contactos/index'>Volver a la lista de contactos</a>
</body>
</html>";
?>