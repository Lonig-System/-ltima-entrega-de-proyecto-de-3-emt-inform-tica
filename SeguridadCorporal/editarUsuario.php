<?php
session_start();
if(isset($_SESSION['nombre'])){
  $apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];
$nombre=$_SESSION['nombre']; 
}else{
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Seguridad Corporal</title>
  <link rel="icon" type="image/svg+xml" href="IMG/logo2.png" />
  <link rel="stylesheet" href="CSS/NavNFooter.css" />
  <link rel="stylesheet" href="CSS/form.css">
  <link rel="stylesheet" href="CSS/usu.css" />
</head>

<body>
  <nav>
    <?php
      include("PHP/menuUsuario.php");
      menu($tipo, $nombre, $apellido);
    ?>
    <div class="icono">
      <a href="Index.php">
        <img id="isotipo" src="IMG/Isotipo.png" title="SeguridadCorporal" />
      </a>
    </div>
    <!--/Inicio de sesion, registro, logotipo e isotipo-->
    <!--Navegacion-->
    <div class="topnav" id="myTopnav">
    <a href="Index.php" class="active">Inicio</a>
      <div class="dropdown">
        <button class="dropbtn">Productos 
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
        <a href="Productos.php?Tipo=0">Productos</a>
          <a href="Productos.php?Tipo=1">Cascos</a>
          <a href="Productos.php?Tipo=2">Gafas</a>
          <a href="Productos.php?Tipo=3">Auriculares</a>
          <a href="Productos.php?Tipo=4">Guantes</a>
          <a href="Productos.php?Tipo=5">Buzos</a>
          <a href="Productos.php?Tipo=6">Pantalones</a>
          <a href="Productos.php?Tipo=7">Calzado</a>
          <a href="Productos.php?Tipo=8">Trajes</a>
          <a href="Productos.php?Tipo=9">Otros</a>
          <a href="Productos.php?Tipo=10">Paquetes</a>
        </div>
      </div> 
      <a href="Contacto.php">Contacto</a>
      <a href="carrito.php">Carrito</a>
      <!-- Responsive-->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">Menu</a>
    </div>
    <!--/Navegacion-->
    
  </nav>


  <?php

  include("PHP/Conexion.php");
  $conexion=abrirConexion();
  $sentencia = $conexion->prepare("SELECT NumUsuario, Nombre, Apellido, Correo, Telefono, FNacimiento FROM usuario where NumUsuario=?");
  $sentencia->bind_param("i",$usuario);
  $sentencia->execute();
  $sentencia->store_result();
  $sentencia->bind_result( $NumUsuario, $Nombre, $Apellido, $Correo, $Telefono, $FNacimiento); //obtener los datos de cada columna
  $sentencia->fetch();  


?>
  <section class="form">

    <form action="PHP/editarUsu.php" method="POST">
      <h4>Modificacion</h4>
      <input class="controls" pattern="[a-zA-Z]+" required type="text" name="nombre" 
        value="<?php  echo $Nombre  ;  ?>" >
      <input class="controls" pattern="[a-zA-Z]+" required type="text" name="apellido" 
        value="<?php  echo $Apellido  ;  ?>">
      <input class="controls" required type="email" name="correo" id="correo" 
      value="<?php  echo  $Correo ;  ?>">

      <input class="controls" required type="password" name="con" 
      placeholder="Antigua contra" >
      
        <input class="controls"  type="password" name="contra" 
         value="***" >

      <input type="tel" placeholder="Numero de telefono" name="tel" required class="controls"
      value="<?php  echo $Telefono  ;  ?>">
      <input type="date" name="FNac" placeholder="Fecha de nacimiento" required class="controls"
      value="<?php  echo $FNacimiento  ;  ?>" onchange="calcularEdad()">


      
      <button type="submit" class="btn" name="el" value="false">Listo</button>
      <a href="PHP/Eliminar.php?id=<?php echo $usuario ;?>&ti='usuario'">Eliminar Cuenta</a>
      
      
    </form>
  
    <div class="modal-dialog modal-lg">...</div>
  </section>

  <footer>
    <div class="footerp1">
      <p>© 2022 - Todos los derechos reservados.</p>
      <p>Desarrollado por Lonig System</p>
    </div>
    <div class="footerp2">
      <p>Contacto:</p>
      <p>Teléfono: 092 065 001</p>
      <p>Correo: seguridadcorporal@gmail.com</p>
    </div>
  </footer>
  <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }

    function calcularEdad() {

      var hoy = new Date();
      var cumpleanos = new Date(document.getElementById('t').value);
      var edad = hoy.getFullYear() - cumpleanos.getFullYear();
      var m = hoy.getMonth() - cumpleanos.getMonth();
      if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
      }
      if (!(edad >= 18)) {
        alert("Eres menor de edad");
      }
    }

  </script>
</body>

</html>