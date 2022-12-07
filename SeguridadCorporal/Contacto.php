<?php
session_start();
if(isset($_SESSION['Nusu'])){
$nombre=$_SESSION['nombre'] ;
$apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];
}else{
  $tipo=9;
  $nombre=null;
  $apellido=null;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seguridad Corporal</title>
  <link rel="icon" type="image/svg+xml" href="IMG/logo2.png" />
  <link rel="stylesheet" href="CSS/Contacto.css">
  <link rel="stylesheet" href="CSS/NavNFooter.css" />
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
          <a href="Productos.php?Tipo=7">Calzados</a>
          <a href="Productos.php?Tipo=8">Trajes</a>
          <a href="Productos.php?Tipo=9">Otro</a>
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
  <section>
    <div class="info-form m">
      <h2>Contáctanos</h2>
      <p id="i">Somos una empresa dedicada a la venta de productos <br>de seguridad corporal, aquí es donde puede
        contactarnos y
        consultar, Gracias.
      </p><br><br>
      <p class="p"><b>Telefono: </b>092 065 001</p><br>
      <p class="p"><b>Correo: </b>seguridadcorporal@gmail.com</p><br>
      <p class="p"><b>Direccion: </b>Moltke 1194, Montevideo, Uruguay</p>
      <br><br><br><br><br>
    </div>
    <form action="PHP/contacto.php" method="post" class="fro m">
      <br><input type="text" name="nombre" placeholder="Tu Nombre" class="campo" required><br><br>
      <input type="emal" name="email" placeholder="Tu Email" class="campo" required><br><br>
      <textarea name="mensaje" placeholder="Tu Mensaje..." rows="7"></textarea>
      <br><br>
      <button type="submit" class="btn">Enviar</button><br><br>
      <button type="reset" class="btn" >Borrar</button>
    </form>
  </section>
  
  <footer>
    <div class="footerp1">
      <p>© 2022 - Todos los derechos reservados.</p>
      <p>Desarrollado por Lonig System</p>
    </div>
    <div class="footerp2" style="clear:none;">
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
  </script>
</body>

</html>