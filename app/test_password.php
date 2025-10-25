<?php
// Script de prueba para verificar la contraseña - CORREGIDO
$contrasena_plana = "12345678";

// Usar comillas simples para evitar que PHP interprete el $ como variable
$hash_almacenado = '$2y$10$t4BvEzRRAM.f8XArbRVRTe.KMFszqEJqypfu34bpJ5P88rcQqGDQK';

echo "<h3>Prueba de Verificación de Contraseña - CORREGIDO</h3>";
echo "Contraseña plana: <strong>" . $contrasena_plana . "</strong><br>";
echo "Hash almacenado: <strong>" . $hash_almacenado . "</strong><br>";
echo "Longitud del hash: <strong>" . strlen($hash_almacenado) . "</strong> caracteres<br>";

$resultado = password_verify($contrasena_plana, $hash_almacenado);
echo "Resultado de password_verify: <strong>" . ($resultado ? 'TRUE - ÉXITO' : 'FALSE - FALLÓ') . "</strong><br>";

// Verificar si necesitamos re-hashear
if ($resultado && password_needs_rehash($hash_almacenado, PASSWORD_DEFAULT)) {
    echo "El hash necesita ser actualizado<br>";
} else {
    echo "El hash es válido<br>";
}

// Verificación adicional
echo "<h4>Análisis del Hash:</h4>";
echo "Primeros caracteres: <strong>" . substr($hash_almacenado, 0, 10) . "</strong><br>";
echo "¿Comienza con \$2y\$?: <strong>" . (strpos($hash_almacenado, '$2y$') === 0 ? 'SÍ' : 'NO') . "</strong><br>";
?>