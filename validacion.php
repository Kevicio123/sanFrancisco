<?php
//include('conection.php');
include("node_modules/config/db.php");
$correo=$_POST['correo'];
$contrasenia=$_POST['contrasenia'];
session_start();
$_SESSION['correo']=$correo;

$consulta="SELECT*FROM users where correo='$correo' and contrasenia='$contrasenia' ";

$validacion=mysqli_query($conexion,$consulta);

$tuplas=mysqli_fetch_array($validacion);
if(isset($tuplas)){
if($tuplas['idRoles']==1){
    header ("Location:index.php");
}else if($tuplas['idRoles']==2){
    header ("Location:index2.php");
}else if($tuplas['idRoles']==3){
    header ("Location:index3.php");
}
}
else{
   // echo " datos incorrectos";
   ?>
   <?php
   include("login.php");
   ?>
        
   <?php
}

mysqli_free_result($validacion);
mysqli_close($conexion);
