<?php
include_once("../app/variables.php");

// Manejo de errores
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
$usuario_value = '';

if (isset($_SESSION['error_login'])) {
    $error = $_SESSION['error_login'];
    unset($_SESSION['error_login']);
}

if (isset($_SESSION['usuario_temporal'])) {
    $usuario_value = $_SESSION['usuario_temporal'];
    unset($_SESSION['usuario_temporal']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= app_name ?> - Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo app_url; ?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo app_url; ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo app_url; ?>/public/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?php echo app_url; ?>/public/images/logo_escuela.svg" alt="Logo Escuela" class="img-fluid" style="max-width: 120px;">
    <h3 class="mt-2"><b><?= app_name ?></b></h3>
  </div>
  
  <div class="card card-primary card-outline">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia sesión para comenzar</p>

      <!-- Alerta de Error Simple -->
      <?php if (!empty($error)): ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fas fa-ban"></i> <?php echo htmlspecialchars($error); ?>
      </div>
      <?php endif; ?>

      <form action="controller_login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name="nom_usuario" class="form-control" placeholder="Nombre de usuario" 
                 value="<?php echo htmlspecialchars($usuario_value); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text bg-light">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text bg-light">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">
              <i class="fas fa-sign-in-alt mr-1"></i> Ingresar
            </button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
    <!-- Footer con Copyright -->
    <div class="card-footer text-center">
      <small class="text-muted">
        <i class="fas fa-copyright mr-1"></i> <?php echo date('Y'); ?> <?= app_name ?>
      </small>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="<?php echo app_url; ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo app_url; ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo app_url; ?>/public/dist/js/adminlte.min.js"></script>

</body>
</html>