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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seguridad Corporal</title>
  <link rel="icon" type="image/svg+xml" href="IMG/logo2.png" />
  <link rel="stylesheet" href="CSS/index.css" />
  <link rel="stylesheet" href="CSS/NavNFooter.css" />
  <link rel="stylesheet" href="CSS/Productos.css" />
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

   <!--Slider-->
   <section>
    <div class="slideshow-container">
      <div class="mySlides fade">
        <img src="IMG/Slider1Img.webp" style="width:100%">
      </div>
      <div class="mySlides fade">
        <img src="IMG/Slider2Img.webp" style="width:100%">
      </div>
      <div class="mySlides fade">
        <img src="IMG/Slider3Img.webp" style="width:100%">
      </div>
      <div class="mySlides fade">
        <img src="IMG/Slider4Img.jpg" style="width:100%">
      </div>
    </div>
    <br>
    <!--Botones slider-->
    <div style="text-align:center">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
      <span class="dot" onclick="currentSlide(4)"></span>
    </div>
  </section>
<br>

  <!--Productos Destacados-->
  <section class="page-content">
  
  <div class="flex">
  <div class="ProdDest">
      <h2>Productos de interes</h2>
    </div>

    <?php

      include("PHP/Conexion.php");
          $conexion=abrirconexion();
          $sql = "SELECT * FROM seguridadcorporal.producto
          ORDER BY RAND(10)
          LIMIT 5";
	
	        $resultado = $conexion->query("$sql");
  
    
      if ($resultado->num_rows != 0){
        
        while ($fila = $resultado->fetch_assoc()){
          ?>
            <div class="product-container">
              <h3><?php echo $fila['Nombre'] ; ?></h3>
              <hr>
              <img class="producto" src="IMG/Productos/<?php echo $fila['Foto']; ?>" />
              <hr>


              <div class="block">
                <p>USD$<?php echo $fila['Precio'] ; ?></p>
                <a href="PHP/Carrito.php?idp=<?php echo $fila['IDProducto']; ?>&t=<?php echo  $fila['Tipo']; ?>"><img class="carrito" src="IMG/Carrito.png" alt=""></a>
              </div>
            </div>
          <?php
        }
      }
        ?>
      </div>
    </div>


  </section>

  <!--Footer-->
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

    let slideIndex = 1;
    showSlides(slideIndex);

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");

      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }

      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }
  </script>

  
</body>

</html>