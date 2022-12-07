<?php
session_start();

$nombre=$_SESSION['nombre'] ;
$apellido=$_SESSION['apellido'];
$tipo=$_SESSION['rol'] ;
$usuario=$_SESSION['Nusu'];

echo "<select  name='ver' class='campo' onchange='cargar()' >";
switch($tipo){
    case 0 :
        ?>
            <option value='cliente'>Clientes</option>
            <option value='usuario'>Usuarios</option>
            <option value='producto'>Productos</option>
            <option value='paquete'>Paquetes</option>


        <?php
    break;
}