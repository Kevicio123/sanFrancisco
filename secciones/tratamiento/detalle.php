<?php
    include ("../../db.php");

    if(isset($_GET['txtID'])){
      $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
  
      $sentencia=$conexion->prepare("SELECT * FROM `tratamiento` WHERE idTrat=:idTrat");
      $sentencia->bindParam(":idTrat",$txtID);
      $sentencia->execute();
      $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  
      $nomTrata=$registro["nomTrata"];
      $fechIni=$registro["fechIni"];
      $Comentarios=$registro["Comentarios"];
      $estadoTratamiento=$registro["estadoTratamiento"];
      $idPaciente=$registro["idPaciente"];
      $idDoctor=$registro["idDoctor"];
      $idTipSer=$registro["idTipSer"];
  
  $sentencia=$conexion->prepare("SELECT *,
  (SELECT dni FROM paciente 
  WHERE tratamiento.idPaciente=paciente.idPaciente limit 1) as dni,
  (SELECT nombres FROM doctor 
  WHERE tratamiento.idDoctor=doctor.idDoctor limit 1) as doctor,
  (SELECT nomSer FROM tiposervicio 
  WHERE tratamiento.idTipSer=tiposervicio.idTipSer limit 1) as servicio
  FROM `tratamiento` WHERE idTrat=$txtID");

  $sentencia->execute();
  $pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);
  
  foreach( $pacientes as $paciente ){
    $dni=$paciente['dni'];
    $doctor=$paciente['doctor'];
    $servicio=$paciente['servicio'];

  }

  
  $sentencia=$conexion->prepare("SELECT *
  FROM `examen` e
  INNER JOIN `tratamiento` t ON t.idTrat = e.idTrat
  WHERE t.idTrat =$txtID");
  $sentencia->execute();
  $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);



  $sentencia=$conexion->prepare("SELECT *
  FROM `tratamiento` t 
  INNER JOIN `paciente` p ON p.idPaciente = t.idPaciente
  INNER JOIN `atencion` a ON a.idPaciente =p.idPaciente
  WHERE t.idTrat =$txtID");
  $sentencia->execute();
  $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);


  $n=1;


}

?>

<?php
$url_base="http://localhost/proySanFranciscoPHP/";

?>
<?php 

session_start();
$user_session=$_SESSION['correo'];
$paciente = $conexion->prepare
("SELECT * FROM users 
WHERE correo = '$user_session'");
$paciente->execute();
$pacientes=$paciente->fetchAll(PDO::FETCH_ASSOC);


foreach($pacientes as $paciente ){
    $rol=$paciente['idRoles'];
}

?>

<?php
    if($rol==1){
        include("../../templates/header.php");   
    }else if($rol==2){
        include("../../templates/Doctor/header.php");
    }
?>



<br><br><br>
<div class="jumbotron">
  <h3 class="display-4">Tratamiento: <?php echo $nomTrata;?></h3>
  <hr class="my-4"> 
  <p class="lead"><strong> Detalle del Tratamiento: </strong> <br><?php echo $Comentarios;?></p>
  <p class="lead"><strong> Estado: </strong> <br><?php echo $estadoTratamiento;?></p>
  <p class="lead"><strong> Paciente Tratante: </strong> <br> <?php echo $dni ?> </p>
  <p class="lead"><strong> Médico Tratante: </strong> <br> <?php echo $doctor ?> </p>
  <p class="lead"><strong> Tipo de Servicio: </strong> <br> <?php echo $servicio ?> </p>
  
  <br>
  <h4 class="display-4">Exámenes Médicos: </h4>
  <hr class="my-4"> 
  <?php foreach($registros as $registro) 
                
  { ?>
  <p class="lead"><strong> * <?php echo $registro['tipExamen'];?> </strong> </p>
  <p class="lead"><strong> </strong> <?php echo $registro['comentarios'];?></p>
  <?php if (isset($registro['examen'])?$registro['examen']:""){ ?><b> <p class="text-success">Estado: Enviado</p></b>
    
  <a href="../examen/<?php echo $registro['examen']?>" download="examenDescarga" 
   class="btn btn-primary">Descargar</a>


  <?php
  }else{ ?> 
  <b> <p class="text-danger">Estado: Pendiente</p></b>
  <?php } ?> 
  <hr class="my-4"> 
  <?php } ?>
  
  <br>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="../examen/create.php" role="button">Asignar Exámenes</a>
  </p>
  <br>

  <h4 class="display-4">Atenciones Realizadas: </h4>
  <hr class="my-4"> 
  <?php foreach($lista_pacientes as $paciente) 
                
  { ?>
  <p class="lead"><b> Atención # <?php echo $n++;?></b></p>
  <p class="lead"><strong> Fecha de la Atención: </strong> <br><?php echo $paciente['fechAten'];?></p>
  <p class="lead"><strong> Link de la Atención: </strong> <br> <a target="blank" href="<?php echo $paciente['linkAten']; ?>"><?php echo $paciente['linkAten'];?></a></p>
  <p class="lead"><strong> Estado: </strong> <br><?php echo $paciente['estado'];?></p>
  <hr class="my-4"> 
  <?php } ?>

</div>


<?php include("../../templates/footer.php");?>