<?php
// 2 PARA BLOQ DE SESION 2:47 BD 

if($_POST){
    
        $mensaje="Error: El usuario o contraseña son incorrectos";
}
?>
<!-- 
  session_start();
if($_POST){
    if(($_POST['usuario']=="asistente")&&($_POST['contrasenia']=="sistema")){
        $_SESSION['usuario']=="ok";
        $_SESSION['nombreUsuario']=="asistente";
        header ('Location:inicio.php');
 
    }else{
        $mensaje="Error: El usuario o contraseña son incorrectos";
    }
}



include("config/bd.php");
session_start();

if($_POST){

  $ps=$conexion->prepare("SELECT contrasenia FROM usuarios where usuario=:usuario");
  $ps->bindParam(':usuario',$_POST['usuario']);
  $ps->execute();
  $usuario=$ps->fetch(PDO::FETCH_LAZY);


  if(($_POST['contrasenia']==$ps)){

        $_SESSION['usuario']=="ok";
        $_SESSION['nombreUsuario']==$usuario['usuario'];
        header ('Location:inicio.php');
        
 
    }else{
        $mensaje="Error: El usuario o contraseña son incorrectos";
    }
}
include("config/bd.php");
session_start();

if($_POST){
  $user=$_POST['usuario'];
  $pwrd=$_POST['contrasenia'];
  $consulta=$conexion->prepare("SELECT*FROM usuarios where usuario='$user' and contrasenia='$pwrd' ");
  $consulta->execute();
  $resultado=$consulta->fetch(PDO::FETCH_LAZY);
  $filas=mysqli_num_rows($usuario);


  if($filas){

       
        header ('Location:inicio.php');
        
 
    }else{
        $mensaje="Error: El usuario o contraseña son incorrectos";
    }
}
mysqli_free_result($resultado);
mysqli_close($conexion);
-->




<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags  PARA USUARIO CON BD EN 2:45-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"  type="text/css" href="css/style.css" />
    

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>



</head>
  <body >

<div class="estilo1">
        

<section class="login-block">
  <div class="container">
	<div class="row">
        <div class="col-md-4 login-sec">
            <h2 class="text-center">Ingresar a la Plataforma</h2>
            
            <?php if(isset($mensaje)) {?>
            <div class="alert alert-danger" role="alert">
              <?php echo $mensaje ;?>
            </div>
            <?php } ?>
                <form  action="validacion.php" class="login-form" method="POST" >
                  <!-- zona nueva
                    <div class="botones">
                    <?php $url="http://".$_SERVER['HTTP_HOST']."/plataforma1" ?> 
                      <button type="nav-link"  href="<?php echo $url;?>/administrador/seccion/doctores.php" class="btn btn-usuarios ">Administrador</button>
                    
                      <button type="nav-link" class="btn btn-usuarios ">Doctor</button>
                        
                        <button type="nav-link" class="btn btn-usuarios ">Paciente</button>
           
                    </div>
                    </br>-->
                      <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Usuario</label>
                        <input type="email" class="form-control" name="correo" placeholder="123@gmail.com">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1" class="text-uppercase">Contraseña</label>
                        <input type="password"  name="contrasenia" class="form-control" placeholder="Contraseña">
                        
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                          <small>Recordar</small>
                        </label>
                        <button type="submit" class="btn btn-login float-right">Ingresar</button>
                      </div>
                </form>
                <div class="copy-text"> <i class="fa fa-heart"></i>  <a href="indexPrincipal.php">Regresar a la página principal</a></div>
        </div>


<style>

.btn-usuarios{
  background: #2ca;
  color:#fff;
  font-weight:600;
  margin-right:6px
  }
</style>

		<div class="col-md-8 banner-sec">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
        <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                      <div class="banner-text">
                          <h2>PLATAFORMA DE SAN FRANSISCO</h2>
                          <p>Ingresa tus credenciales de paciente, doctor o administrador en los campos de usuario y contraseña</p>
                      </div>	
                    </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="2">
                  <div class="carousel-caption d-none d-md-block">
                    <div class="banner-text">
                    <h2>PLATAFORMA DE SAN FRANSICO</h2>
                        <p>Ingresa tus credenciales de paciente, doctor o administrador en los campos de usuario y contraseña</p>
                    </div>	
                  </div>
                </div>
        </div>	   
		    
		    </div>
        </div>

	</div>
  </div>
</section>
        
           
        
</div>






        <style>
          .estilo1{
            display: flex;
            justify-content: center;
             align-items: center;
             width: 100%;
           height: 100%;
           position: absolute;
           background: #DE6262;  /* fallback for old browsers */
           background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
          background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
          }


           .banner-sec{background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
          .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
          .carousel-inner{border-radius:0 10px 10px 0;}
          .carousel-caption{text-align:left; left:5%;}
          .login-sec{padding: 50px 30px; position:relative;}
          .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
          .login-sec .copy-text i{color:#FEB58A;}
          .login-sec .copy-text a{color:#E36262;}
          .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
          .login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
          .btn-login{background: #DE6262; color:#fff; font-weight:600;}
          .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
          .banner-text h2{color:#fff; font-weight:600;}
          .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
          .banner-text p{color:#fff;}

    </style>
  </body>

</html>