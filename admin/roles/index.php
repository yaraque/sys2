<?php
    include_once("../../app/variables.php");
    include("../layout/header.php");
    include_once("../../app/controllers/roles/lista_roles.php");
?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <div class="content">
      <div class="container">
        <div class="row">
          <h1><b>Lista de Roles</b></h1>
        </div>
        <div class="row">
          <table border="1">
            <thead>
              <tr>
                <th>Id</th>
                 <th>Descrpción de Rol</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>  
              <td>1</td>
              <td>administrador</td>
              <td>registrar ver editar</td>
              </tr>
            </tbody>
          </table>
          </div>
      </div>
    </div>
    
  </div>
  <!-- /.content-wrapper -->
  
  
<?php
    include("../layout/footer.php");
?>