<?php include("../templates/Paciente/header.php");?>

<?php include("../db.php");?>

<?php include("../principal.php");?>

<?php 

$url_base="http://localhost/proySanFranciscoPHP/secciones/paciente/"; 
$url_index="http://localhost/proySanFranciscoPHP/"; 

?>

<div class="container">
<br>
<div class="row"> 

<h2 >Información Personal</h2>
<div class="col-md-4"> </div>


<div class="col-md-4"> 

<br><br>

<br>
<div class="card border-info mb-3" style="width: 28rem;">
  <div class="card-body text-info">
    <h5 class="card-title">Nombre Completo</h5>
    <p class="card-text"><?php echo $nombres?></p>
  </div>
  <div class="card-header">
    <p class="card-title"><b>DNI:</b>  <?php echo $dni?></p>
    <p class="card-title"><b>Localidad:</b>  <?php echo $direccion.', '.$distrito?></p>
    <p class="card-title"><b>Celular:</b>  <?php echo $celular?></p>
    <p class="card-title"><b>Fecha Nacimiento:</b>  <?php echo $fecha?></p>
    <p class="card-title"><b>Lugar de Nacimiento:</b>  <?php echo $lugarNac?></p>
    <p class="card-title"><b>Usuario:</b>  <?php echo $correo?></p>
    
  </div>
  
</div>
</div>





</div>
</div>





<?php include("../templates/footer.php");?>