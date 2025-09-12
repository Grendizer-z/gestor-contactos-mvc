<?php
echo "Vista para editar contacto<br>";

echo "ID del contacto a editar: " . htmlspecialchars($data['contacto'][0]['id']) . "<br>";
echo "<form method='POST' action='/contactos/edit/" . htmlspecialchars($data['contacto'][0]['id']) . "'>";
echo "
    <label>Nombre:</label>
    <input type='text' name='nombre' value='" . htmlspecialchars($data['contacto'][0]['nombre']) . "' required><br>
    <label>Teléfono:</label>
    <input type='text' name='telefono' value='" . htmlspecialchars($data['contacto'][0]['telefono']) . "' required><br>
    <label>Email:</label>
    <input type='email' name='email' value='" . htmlspecialchars($data['contacto'][0]['email']) . "' required><br>
    <button type='submit'>Guardar Cambios</button>
</form>";
echo "<a href='/contactos/index'>Volver a la lista de contactos</a>";
?>