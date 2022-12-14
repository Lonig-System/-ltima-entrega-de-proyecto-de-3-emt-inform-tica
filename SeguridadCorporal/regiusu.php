<?php
session_start();

$nombre=$_SESSION['nombre'] ;
$apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];
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
    <!--Inicio de sesion, registro, logotipo e isotipo-->
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
      <a href="php.php">Carrito</a>
      <!-- Responsive-->
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">Menu</a>
    </div>
    <!--/Navegacion-->
  </nav>



  <section class="form">

    <form action="PHP/registro.php" method="POST">
      <h4>Registrarse</h4>
      <input class="controls" pattern="[a-zA-Z]+" required type="text" name="nombre" 
        placeholder="Ingrese su Nombre">
      <input class="controls" pattern="[a-zA-Z]+" required type="text" name="apellido" 
        placeholder="Ingrese su Apellido">
      <input class="controls" required type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
      <input class="controls" required type="password" name="con" 
        placeholder="Ingrese su Contrase??a">
      <input type="tel" placeholder="Numero de telefono" name="tel" required class="controls">
      <input type="date" name="FNac" placeholder="Fecha de nacimiento" required class="controls" onchange="calcularEdad()">
      <select name="Tipo" class="controls">
        <option value="1">Vendedor </option>
        <option value="2" >Comprador </option>
        <option value="4" >Cliente </option>
      </select>
      <input type="hidden" name="ubicacion" value="regiusu.php">
      
    
      <button type="submit" class="btn">Registrar</button>
    
      
    </form>


  </section>

  <footer>
    <div class="footerp1">
      <p>?? 2022 - Todos los derechos reservados.</p>
      <p>Desarrollado por Lonig System</p>
    </div>
    <div class="footerp2">
      <p>Contacto:</p>
      <p>Tel??fono: 092 065 001</p>
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
  alert("Valor no aceptado");
}
}
  </script>
</body>

</html>