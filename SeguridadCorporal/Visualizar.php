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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
  <link rel="stylesheet" href="CSS/form.css">
  <link rel="stylesheet" href="CSS/usu.css" />
  <link rel="stylesheet" href="CSS/nav.css">
</head>
<body style= "text-decoration: none; color: #000000;">
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
      <div class="cascada">
        <button class="dropbtn">Productos 
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="cascada-content">
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
  <script>

	
    function cargar(){
			let idsel = document.getElementById('selecciones');
				const xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET", "PHP/Visualizar.php?que=" + idsel.value);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.onreadystatechange = function () {
					if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
  						document.getElementById("ver").innerHTML = this.responseText;
  					}
				}
				
				xmlhttp.send();
		}
	</script>


    <form action="" class="form">
    <select  name='ver' class='controls' onchange='cargar()' id='selecciones'>
    <option value=''>Seleccion</option>
    
<?php

  switch($tipo){
    case 0 :
      ?>
        <option value='cliente'>Clientes</option>
        <option value='usuario'>Usuarios</option>
        <option value='producto'>Productos</option>
        <option value='paquete'>Paquetes</option>
        <option value='pedidos'>Pedido</option>

      <?php
    break;
    case 1 :
      ?>
        <option value='cliente'>Clientes</option>
        <option value='pedidos'>Pedido</option>

      <?php
    break;
    case 2:
      ?>
        <option value='producto'>Productos</option>
        <option value='paquete'>Paquetes</option>

      <?php

    break;
  }
  echo "</select>";
?>


</form>

<p id="ver" on></p>
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

  

  </script>
</body>

</html>