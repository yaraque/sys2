<?php
include_once '../app/conexion.php';

// Conectar a la base de datos
$conexion = Conexion::getInstancia();
$conn = $conexion->getConexion();

echo "<h3>Verificación Directa de Usuario en BD</h3>";

// Ver todos los usuarios
$sql = "SELECT id_usuario, nom_usuario, contrasena, estado, rol_id, LENGTH(contrasena) as long_hash FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Contraseña (primeros 20 chars)</th><th>Longitud</th><th>Estado</th><th>Rol</th><th>Probar Login</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_usuario'] . "</td>";
        echo "<td>" . $row['nom_usuario'] . "</td>";
        echo "<td>" . substr($row['contrasena'], 0, 20) . "...</td>";
        echo "<td>" . $row['long_hash'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo "<td>" . $row['rol_id'] . "</td>";
        echo "<td><a href='#' onclick='probarLogin(\"" . $row['id_usuario'] . "\")'>Probar</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay usuarios en la tabla";
}

$conn->close();
?>

<script>
function probarLogin(usuario) {
    var contrasena = prompt("Ingresa la contraseña para " + usuario + ":");
    if (contrasena !== null) {
        // Aquí puedes hacer una prueba AJAX o simplemente mostrar la info
        alert("Usuario: " + usuario + "\nContraseña: " + contrasena);
    }
}
</script>