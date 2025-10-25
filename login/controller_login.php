<?php
include_once '../app/conexion.php';

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Solo procesar si es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_usuario']) && isset($_POST['contrasena'])) {
    
    $nom_usuario = $_POST['nom_usuario'];
    $contrasena = $_POST['contrasena'];
    
    // Validar que no estén vacíos
    if (empty($nom_usuario) || empty($contrasena)) {
        $_SESSION['error_login'] = 'Todos los campos son obligatorios';
        header('Location: index.php');
        exit();
    }
    
    // Conectar a la base de datos
    $conexion = Conexion::getInstancia();
    $conn = $conexion->getConexion();
    
    // Buscar usuario por NOMBRE
    $sql = "SELECT nom_usuario, contrasena FROM usuarios WHERE nom_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nom_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    $stmt->close();
    
    // Verificar si existe el usuario y la contraseña
    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        // Login exitoso - redirigir a admin
        $_SESSION['usuario'] = $nom_usuario;
        $_SESSION['logged_in'] = true;
        header('Location: ../admin/index.php');
        exit();
        
    } else {
        $_SESSION['error_login'] = 'Credenciales incorrectas';
        $_SESSION['usuario_temporal'] = $nom_usuario;
        header('Location: index.php');
        exit();
    }
}

// Si llega aquí sin ser POST, redirigir al login
header('Location: index.php');
exit();
?>