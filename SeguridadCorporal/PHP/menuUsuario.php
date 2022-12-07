<?php

function menu($tipo, $nombre, $apellido){

 
  switch ($tipo) {
    case 0:

      ?>
    <div class="menu">
      <span><?php echo $nombre . " " . $apellido;  ?></span>
      <div class="menu-content">
        <a href="editarUsuario.php" class="content">Cuenta</a><br>
        <a href="Visualizar.php" class="content">Visualizar</a><br>
        <a href="regiusu.php" class="content">Registrar</a><br>
        <a href="AñadirProveedor.php" class="content">Prooveedor</a><br>
        <a href="AñadirProducto.php" class="content">Producto</a><br>
        <a href="Paquete.php" class="content">Paquete</a><br>
        <a href="PHP/Cerrar.php" class="content">Cerrar cesion</a><br>
      </div>
    </div>

  <?php
  break;
  case 1:
  ?>
    <div class="menu">
      <span><?php echo $nombre . " " . $apellido;  ?></span>
      <div class="menu-content">
        <a href="editarUsuario.php" class="content">Cuenta</a><br>
        <a href="Visualizar.php" class="content">Validar</a><br>
        <a href="PHP/Cerrar.php" class="content">Cerrar cesion</a><br>
      </div>
    </div>
  
  <?php
  break;
  case 2:
    ?>
    <div class="menu">
      <span><?php echo $nombre . " " . $apellido;  ?></span>
      <div class="menu-content">
        <a href="editarUsuario.php" class="content">Cuenta</a><br>
        <a href="AñadirProveedor.php" class="content">Prooveedor</a><br>
        <a href="AñadirProducto.php" class="content">Producto</a><br>
        <a href="Paquete.php" class="content">Paquete</a><br>
        <a href="Visualizar.php" class="content">Visulizar</a><br>
        <a href="PHP/Cerrar.php" class="content">Cerrar cesion</a><br>
        
      </div>
    </div>

    <?php
  break;
  case 3:
        echo "i es igual a 2";
  break;
  case 4:
      ?>
      <div class="menu">
        <span><?php echo $nombre . " " . $apellido;  ?></span>
        <div class="menu-content">
          <a href="editarUsuario.php" class="content">Cuenta</a><br>
          <a href="Dirreccion.php" class="content">Dirrecion</a><br>
          <a href="PHP/Cerrar.php" class="content">Cerrar cesion</a><br>
          
        </div>
      </div>
  
      <?php
    break;
    default:
  ?>
  <!--Inicio de sesion, registro, logotipo e isotipo-->


  <div class="InicioRegistro">
    <a href="ini.html" class="bor">Iniciar Sesión</a>
    <a href="regi.html">Registrarse</a>
  </div>

  <?php
      break;
    }
  ?>
 <?php

}