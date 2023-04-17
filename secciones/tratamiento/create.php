<?php
include ("../../db.php");

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




    if($rol==1){
        include("../../templates/header.php");   
    }else if($rol==2){
        include("../../templates/Doctor/header.php");
    }

?>


<?php

if($_POST){
    // Recolectamos los datos
    $nomTrata=(isset($_POST["nomTrata"])?$_POST["nomTrata"]:"");
    $dx=(isset($_POST["dx"])?$_POST["dx"]:"");
    $fechIni=(isset($_POST["fechIni"])?$_POST["fechIni"]:"");
    $Comentarios=(isset($_POST["Comentarios"])?$_POST["Comentarios"]:"");
    $estadoTratamiento=(isset($_POST["estadoTratamiento"])?$_POST["estadoTratamiento"]:"");
    $idPaciente=(isset($_POST["idPaciente"])?$_POST["idPaciente"]:"");
    $idDoctor=(isset($_POST["idDoctor"])?$_POST["idDoctor"]:"");
    $idTipSer=(isset($_POST["idTipSer"])?$_POST["idTipSer"]:"");

    // Insertamos los datos a la BD
    $sentencia=$conexion->prepare
    ("INSERT INTO tratamiento(idTrat,nomTrata,dx,fechIni,Comentarios,estadoTratamiento,
    idPaciente,idDoctor,idTipSer)
    VALUES(null,:nomTrata,:dx,:fechIni,:Comentarios,:estadoTratamiento,
    :idPaciente,:idDoctor,:idTipSer)");

    
    // Asignando los valores del formulario
    $sentencia->bindParam(":nomTrata",$nomTrata);
    $sentencia->bindParam(":dx",$dx);
    $sentencia->bindParam(":fechIni",$fechIni);
    $sentencia->bindParam(":Comentarios",$Comentarios);
    $sentencia->bindParam(":estadoTratamiento",$estadoTratamiento);
    $sentencia->bindParam(":idPaciente",$idPaciente);
    $sentencia->bindParam(":idDoctor",$idDoctor);
    $sentencia->bindParam(":idTipSer",$idTipSer);
    $sentencia->execute();
    $mensaje="Tratamiento Creado Correctamente";
    if($rol==1){ 
    header("Location:index2.php?mensaje=".$mensaje);
    }else if($rol==2){
    header("Location:../../doctor/index2.php?mensaje=".$mensaje);
    }

}

  $sentencia=$conexion->prepare("SELECT * FROM `paciente`");
  $sentencia->execute();
  $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

  $sentencia=$conexion->prepare("SELECT * FROM `doctor`");
  $sentencia->execute();
  $lista_doctores=$sentencia->fetchAll(PDO::FETCH_ASSOC);

  $sentencia=$conexion->prepare("SELECT * FROM `tiposervicio`");
  $sentencia->execute();
  $lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>



    <br>
    <br> 

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Registro de Tratamientos</h3>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Nombre del Tratamiento!</strong> Inicia con la palabra "TRAT-" seguido de los 3 últimos
    dígitos del DNI del Paciente + #Número del Tratamiento
    </div>

    <div class="col-md-4">
    <label for="idPaciente" class="form-label">Paciente</label>
    
    <select id="idPaciente" name="idPaciente" class="form-select">
    <option selected>Paciente</option>
    <?php foreach($lista_pacientes as $paciente)            
    { ?>
      <option value="<?php echo $paciente['idPaciente']; ?>">
        <?php echo $paciente['dni']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    <div class="col-md-4">
    <label for="nomTrata" class="form-label">Tratamiento:</label>
    <input type="text" class="form-control" id="nomTrata" name="nomTrata">
    </div>

    <div class="col-md-4">
    <label for="dx" class="form-label">DX:</label>
    <input type="text" class="form-control" id="dx" name="dx">
    </div>

    <div class="col-md-8">
    <label for="Comentarios" class="form-label">Comentarios</label>
    <input type="text" class="form-control" id="Comentarios" name="Comentarios">
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
    <input type="date" class="form-control" id="fechIni" name="fechIni">
    </div>

    <div class="col-md-4">
    <label for="idDoctor" class="form-label">Médico Tratante</label>
    
    <select id="idDoctor" name="idDoctor" class="form-select">
    <option selected>Doctor</option>
    <?php foreach($lista_doctores as $doctor)            
    { ?>
      <option value="<?php echo $doctor['idDoctor']; ?>">
        <?php echo $doctor['nombres']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    <div class="col-md-4">
    <label for="idTipSer" class="form-label">Tipo de Servicio</label>
    
    <select id="idTipSer" name="idTipSer" class="form-select">
    <option selected>Servicio</option>
    <?php foreach($lista_servicios as $servicio)            
    { ?>
      <option value="<?php echo $servicio['idTipSer']; ?>">
        <?php echo $servicio['nomSer']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>

    </form>

    
 
    




<?php include("../../templates/footer.php");?>