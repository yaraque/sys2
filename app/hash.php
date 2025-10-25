<?php
$contrasena_plana = "12345678"; // ⬅️ IMPORTANTE: Reemplaza con la contraseña real
$hash_seguro = password_hash($contrasena_plana, PASSWORD_DEFAULT);

echo "Contraseña simple para login: <strong>" . $contrasena_plana . "</strong><br>";
echo "Contraseña encriptada: <strong>" . $hash_seguro . "</strong><br>";
?>