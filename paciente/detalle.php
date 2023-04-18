<?php

include("../db.php");
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
  
    $sentencia=$conexion->prepare("SELECT * FROM `atencion` WHERE idAtencion=:idAtencion");
    $sentencia->bindParam(":idAtencion",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  
      $fechAten=$registro["fechAten"];
      $hora=$registro["hora"];
      $linkAten=$registro["linkAten"];
      $Comentarios=$registro["Comentarios"];
      $estado=$registro["estado"];
      $asistencia=$registro["asistencia"];
      $idDoctor=$registro["idDoctor"];
      $idPaciente=$registro["idPaciente"];
      $modalidad=$registro["modalidad"];
  
      $sentencia=$conexion->prepare("SELECT *,
      (SELECT dni FROM paciente 
      WHERE atencion.idPaciente=paciente.idPaciente limit 1) as dni,
      (SELECT nombres FROM doctor 
      WHERE atencion.idDoctor=doctor.idDoctor limit 1) as doctor
      FROM `atencion` WHERE idAtencion=$txtID");
      $sentencia->execute();
      $pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);
      
      foreach( $pacientes as $paciente ){
        $dni=$paciente['dni'];
        $doctor=$paciente['doctor'];
      }
  
  
  }
?>


<?php include("../templates/Paciente/header.php");?>
<br><br>

<?php
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es'); // establece la configuración regional en español
$fecha = $fechAten; // fecha de ejemplo en formato ISO
$timestamp = strtotime($fecha);
$fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                ?>
<?php
$hora = $hora; // ejemplo de dato de tipo time
$hora_am_pm = date("h:i A", strtotime($hora));
?>

<div class="jumbotron">
  <h3 class="display-4">Atención Médica: Modalidad <?php echo $modalidad;?></h3>
  <hr class="my-4"> 
  <p class="lead"><strong> Fecha de Atención: </strong> <br><?php echo $fecha_formateada;?></p>
  <p class="lead"><strong> Hora: </strong> <br><?php echo $hora_am_pm;?></p>
  <p class="lead"><strong> Estado de Reunión: </strong> <br> <?php echo $estado ?> </p>
  <p class="lead"><strong> Médico en Atención: </strong> <br> <?php echo $doctor ?> </p>
  <p class="lead"><strong> Paciente Tratante: </strong> <br> <?php echo $dni ?> </p>
  <p class="lead"><strong> Link de la Reunión: </strong> <br> <a href="<?php echo $linkAten ?>" target="_blank"><?php echo $linkAten ?> </a></p>
  <p class="lead"><strong> Asistencia: </strong> <br> <?php echo $asistencia ?> </p>
  <p class="lead"><strong> Detalle Reunión: </strong> <br> <?php echo $Comentarios ?> </p>
  
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="atenciones.php" role="button">Regresar en Atenciones</a>
  </p>
  <hr class="my-4"> 
 
</div>




<?php include("../templates/Paciente/footer.php");?>