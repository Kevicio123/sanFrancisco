<?php 
include ("../../db.php");
?>

<?php 

session_start();
$user_session=$_SESSION['correo'];
$paciente2 = $conexion->prepare
("SELECT * FROM users 
WHERE correo = '$user_session'");
$paciente2->execute();
$pacientes2=$paciente2->fetchAll(PDO::FETCH_ASSOC);


foreach($pacientes2 as $paciente ){
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




<?php

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `tratamiento` WHERE idTrat=:idTrat");
    $sentencia->bindParam(":idTrat",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $nomTrata=$registro["nomTrata"];
    $dx=$registro["dx"];
    $fechIni=$registro["fechIni"];
    $Comentarios=$registro["Comentarios"];
    $estadoTratamiento=$registro["estadoTratamiento"];
    $idPaciente=$registro["idPaciente"];
    $idDoctor=$registro["idDoctor"];
    $idTipSer=$registro["idTipSer"];
}

// Intrucción de recolección de datos

if($_POST){
    // Recolectamos los datos
  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  $nomTrata=(isset($_POST["nomTrata"])?$_POST["nomTrata"]:"");
  $dx=(isset($_POST["dx"])?$_POST["dx"]:"");
    $fechIni=(isset($_POST["fechIni"])?$_POST["fechIni"]:"");
    $Comentarios=(isset($_POST["Comentarios"])?$_POST["Comentarios"]:"");
    $estadoTratamiento=(isset($_POST["estadoTratamiento"])?$_POST["estadoTratamiento"]:"");
    $idPaciente=(isset($_POST["idPaciente"])?$_POST["idPaciente"]:"");
    $idDoctor=(isset($_POST["idDoctor"])?$_POST["idDoctor"]:"");
    $idTipSer=(isset($_POST["idTipSer"])?$_POST["idTipSer"]:"");

    // Actualizamos los datos de la BD
    $sentencia=$conexion->prepare
  ("UPDATE tratamiento SET
  nomTrata=:nomTrata,
  dx=:dx,
  fechIni=:fechIni,
  Comentarios=:Comentarios,
  estadoTratamiento=:estadoTratamiento,
  idPaciente=:idPaciente,
  idDoctor=:idDoctor,
  idTipSer=:idTipSer
  WHERE idTrat=:idTrat");

 
    // Asignando los valores del formulario
    $sentencia->bindParam(":nomTrata",$nomTrata);
    $sentencia->bindParam(":dx",$dx);
    $sentencia->bindParam(":fechIni",$fechIni);
    $sentencia->bindParam(":Comentarios",$Comentarios);
    $sentencia->bindParam(":estadoTratamiento",$estadoTratamiento);
    $sentencia->bindParam(":idPaciente",$idPaciente);
    $sentencia->bindParam(":idDoctor",$idDoctor);
    $sentencia->bindParam(":idTipSer",$idTipSer);
    $sentencia->bindParam(":idTrat",$txtID);
    $sentencia->execute();

    if($rol==1){ 
    $mensaje="Tratamiento Actualizado correctamente";
    header("Location:index2.php?mensaje=".$mensaje);
    }else if($rol==2){
    $mensaje="Tratamiento Actualizado correctamente";
    header("Location:../../doctor/index2.php?mensaje=".$mensaje);
    }
}

  $sentencia=$conexion->prepare("SELECT * FROM `paciente`");
  $sentencia->execute();
  $pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

  $sentencia=$conexion->prepare("SELECT * FROM `doctor`");
  $sentencia->execute();
  $doctores=$sentencia->fetchAll(PDO::FETCH_ASSOC);

  $sentencia=$conexion->prepare("SELECT * FROM `tiposervicio`");
  $sentencia->execute();
  $servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>



    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Actualización de Tratamientos</h3>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Nombre del Tratamiento!</strong> Inicia con la palabra "TRAT-" seguido de los 3 últimos
    dígitos del DNI del Paciente + #Número del Tratamiento
    </div>

    <div class="col-md-4" hidden>
    <label for="idTrat" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="txtID" name="txtID">
    </div>


    <div class="col-md-4">
    <label for="idPaciente" class="form-label">Paciente</label>
    
    <select id="idPaciente" name="idPaciente" class="form-select">
    <?php foreach($pacientes as $paciente)            
    { ?>
      <option <?php echo($idPaciente==$paciente['idPaciente'])?"selected":"";?>
      value="<?php echo $paciente['idPaciente']; ?>">
        <?php echo $paciente['dni']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    <div class="col-md-4">
    <label for="nomTrata" class="form-label">Tratamiento</label>
    <input type="text" class="form-control" id="nomTrata" 
    value="<?php echo $nomTrata; ?>" name="nomTrata">
    </div>

    <div class="col-md-4">
    <label for="dx" class="form-label">DX</label>
    <input type="text" class="form-control" id="dx" 
    value="<?php echo $dx; ?>" name="dx">
    </div>

    <div class="col-md-8">
    <label for="Comentarios" class="form-label">Comentarios</label>
    <input type="text" class="form-control" id="Comentarios" 
    value="<?php echo $Comentarios; ?>" name="Comentarios">
    </div>

    <div class="col-md-4">
    <label for="estadoTratamiento" class="form-label">Estado del Tratamiento</label>
    <select id="estadoTratamiento" name="estadoTratamiento" class="form-select">
      <option value="Activo">Activo</option>
      <option value="Inactivo">Inactivo</option>
    </select>
    </div>

    <div class="col-md-4">
    <label for="fechIni" class="form-label">Fecha de Inicio</label>
    <input type="date" class="form-control" id="fechIni" name="fechIni"
    value="<?php echo $fechIni; ?>">
    </div>

    <div class="col-md-4">
    <label for="idDoctor" class="form-label">Médico Tratante</label>
    
    <select id="idDoctor" name="idDoctor" class="form-select">
    <option selected>Doctor</option>
    <?php foreach($doctores as $doctor)            
    { ?>
      <option <?php echo($idDoctor==$doctor['idDoctor'])?"selected":"";?>
      value="<?php echo $doctor['idDoctor']; ?>">
        <?php echo $doctor['nombres']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    <div class="col-md-4">
    <label for="idTipSer" class="form-label">Tipo de Servicio</label>
    
    <select id="idTipSer" name="idTipSer" class="form-select">
    <option selected>Servicio</option>
    <?php foreach($servicios as $servicio)            
    { ?>
    <option <?php echo($idTipSer==$servicio['idTipSer'])?"selected":"";?>
      value="<?php echo $servicio['idTipSer']; ?>">
        <?php echo $servicio['nomSer']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    <div class="col-12">
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <?php if($rol==1){?>
    <a href="index2.php" type="button"  class="btn btn-dark">Regresar</a>
    <?php }else if($rol==2){ ?>

    <a href="../../doctor/index2.php" type="button"  class="btn btn-dark">Regresar</a>
    <?php }?>
    </div>

    </form>

    





<?php include("../../templates/footer.php");?>