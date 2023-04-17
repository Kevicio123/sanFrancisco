<?php include("../templates/Paciente/header.php");?>

<?php include("../db.php");?>

<?php include("../principal.php");?>

<?php 

$url_base="http://localhost/proySanFranciscoPHP/secciones/paciente/"; 
$url_index="http://localhost/proySanFranciscoPHP/"; 

?>

<div class="container">
<div class="row"> 


<div class="col-md-4"> </div>


<div class="col-md-4"> 

<br><br>
<h2 align="center">Información Personal</h2>
<br>
<div class="card" style="width: 28rem;">
  <div class="card-body">
    <h5 class="card-title">Nombre Completo</h5>
    <p class="card-text"><?php echo $nombres.' '.$apePat.' '.$apeMat?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><b>DNI:</b>  <?php echo $dni?>
    <li class="list-group-item"><b>Localidad:</b>  <?php echo $direccion.', '.$distrito?></li>
    <li class="list-group-item"><b>Teléfono Celular:</b>  <?php echo $celular?></li>
    <li class="list-group-item"><b>Fecha Nacimiento:</b>  <?php echo $fecha?></li>
    <li class="list-group-item"><b>Lugar de Nacimiento:</b>  <?php echo $lugarNac?></li>
    <li class="list-group-item"><b>Usuario:</b>  <?php echo $correo?></li>
    <li class="list-group-item"><b>Tu imagen:</b> </li>
    <div align="center">
    <img src="../images/administrador/USU.png" width="300px" height="300px" class="img-thumbnail">
    </div>
  </ul>
  <div class="card-body" align="center">
    <a  href="<?php echo $url_index?>index3.php" class="btn btn-primary">Ir al Inicio</a>
  </div>
</div>
</div>

<div class="col-md-4"> </div>

</div>
</div>

<?php include("../templates/footer.php");?>