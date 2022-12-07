<?php
 session_start();
 unset($_SESSION["nombre"]); 
 unset($_SESSION["apellido"]);
 unset($_SESSION["rol"]);
 unset($_SESSION["Nusu"]);
 session_destroy();
 header("Location: ../index.php");