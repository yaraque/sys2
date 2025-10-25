<?php
// sys/login/controller_login.php
session_start();
include_once("../app/conexion.php");

// Verificar que sea método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Error: Método no permitido";
    exit();
}

// Obtener datos del formulario
$usuario = trim($_POST['usuario'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

// Validar campos vacíos
if (empty($usuario) || empty($contrasena)) {
    echo "Por favor ingresa tu usuario y contraseña";
    exit();
}

try {
    // Crear conexión
    $db = new Conexion();
    $mysqli = $db->getConexion();
    
    // Buscar usuario en la base de datos
    $sql = "SELECT id, nom_usuario, contrasena FROM usuarios WHERE nom_usuario = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verificar si el usuario existe
    if ($result->num_rows === 0) {
        echo "Usuario o contraseña incorrectos";
        exit();
    }
    
    // Obtener datos del usuario
    $usuarioData = $result->fetch_assoc();
    $stmt->close();
    
    // Verificar contraseña HASHEADADA
    $contrasena_bd = $usuarioData['contrasena'];
    
    // DEBUG: Mostrar información temporalmente
    // echo "Contraseña BD: " . $contrasena_bd . "<br>";
    // echo "Contraseña ingresada: " . $contrasena . "<br>";
    // echo "¿Es hash válido?: " . (password_verify($contrasena, $contrasena_bd) ? "Sí" : "No");
    
    if (password_verify($contrasena, $contrasena_bd)) {
        // Login exitoso
        $_SESSION['id_usuario'] = $usuarioData['id'];
        $_SESSION['usuario'] = $usuarioData['nom_usuario'];
        echo "¡Bienvenido!";
    } else {
        echo "Usuario o contraseña incorrectos";
    }
    
} catch (Exception $e) {
    echo "Error del sistema: " . $e->getMessage();
}
?>