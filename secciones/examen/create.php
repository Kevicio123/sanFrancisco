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

if($_POST){

    // Recolectamos los datos
    
    $tipExamen=(isset($_POST["tipExamen"])?$_POST["tipExamen"]:"");
    $comentarios=(isset($_POST["comentarios"])?$_POST["comentarios"]:"");
    $idTrat=(isset($_POST["idTrat"])?$_POST["idTrat"]:"");
    $idPaciente=(isset($_POST["idPaciente"])?$_POST["idPaciente"]:"");
    $examen=(isset($_FILES["examen"]['name'])?$_FILES["examen"]['name']:"");
    
    // Insertamos los datos a la BD
    $sentencia=$conexion->prepare
    ("INSERT INTO examen(idExamen,tipExamen,examen,comentarios,idTrat,idPaciente)
    VALUES(null,:tipExamen,:examen,:comentarios,:idTrat,:idPaciente)");

    
    // Asignando los valores del formulario
    $sentencia->bindParam(":tipExamen",$tipExamen);

    // Moviendo el archivo a una carpeta del proyecto
    $fecha= new DateTime();
    $nombreArchivo_examen=($examen!='')?$fecha->getTimestamp()."_".$_FILES['examen']['name']:"";

    $tmp_examen=$_FILES["examen"]['tmp_name'];

    if($tmp_examen!=''){
      move_uploaded_file($tmp_examen,"./".$nombreArchivo_examen);
    }

    $sentencia->bindParam(":examen",$nombreArchivo_examen);
    $sentencia->bindParam(":comentarios",$comentarios);
    $sentencia->bindParam(":idTrat",$idTrat);
    $sentencia->bindParam(":idPaciente",$idPaciente);
    $sentencia->execute();

    if($rol==1){ 
    $mensaje="Examen Creado correctamente";
    header("Location:index.php?mensaje=".$mensaje);
    }else if($rol==2){
    $mensaje="Examen Creado correctamente";
    header("Location:../../doctor/listaExamenes.php?mensaje=".$mensaje);
    }

}

$sentencia=$conexion->prepare("SELECT * FROM `paciente`");
$sentencia->execute();
$lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM `tratamiento`");
$sentencia->execute();
$lista_tratamientos=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>


    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Crear Exámen Médico</h3>

    <div class="col-md-4" class="visually-focusable">
    <label for="tipExamen" class="form-label">Nombre del Examen</label>
    <select id="tipExamen" name="tipExamen" class="form-select">
    <option selected>Seleccione</option>
      <option value="Radiofrafía Bitewing">Radiofrafía Bitewing</option>
      <option value="Radiofrafía bucal">Radiofrafía bucal</option>
      <option value="Rayos X panorámicos">Rayos X panorámicos</option>
      <option value="Radiofrafía Periapical">Radiofrafía Periapical</option>
    </select>
    </div>

    <div class="col-md-4">
    <label for="idPaciente" class="form-label">Paciente Tratante</label>
    <select id="idPaciente" name="idPaciente" class="form-select">
    <option selected>Paciente</option>
    <?php foreach($lista_pacientes as $paciente)            
    { ?>
       <option value="<?php echo $paciente['idPaciente']; ?>">
        <?php echo $paciente['dni']; ?>
      </option>
      </option>
    <?php } ?>
    </select>
    </div>
    
    <div class="col-md-4">
    <label for="idTrat" class="form-label">Nombre del Tratamiento</label>
    <select id="idTrat" name="idTrat" class="form-select">
    <option selected>Tratamiento</option>
    <?php foreach($lista_tratamientos as $tratamiento)            
    { ?>
      <option value="<?php echo $tratamiento['idTrat']; ?>">
        <?php echo $tratamiento['nomTrata']; ?>
      </option>
    <?php } ?>
    </select>
    </div>


    <div class="col-md-8" disabled="true">
    <label for="comentarios" class="form-label">Comentarios</label>
    <input type="text" class="form-control" id="comentarios" name="comentarios">
    </div>


    <div class="col-md-4">
    <label for="examen" class="form-label">Adjunte el Examen: (Imagen)</label>
    <input type="file" class="form-control" id="examen" name="examen" >
    </div>

   

    

    <div class="col-12">
    <button type="submit" class="btn btn-primary">Enviar</button>
    
    <?php if($rol==1){ ?>

    <a href="../tratamiento/index.php" type="button"  class="btn btn-dark">Regresar</a>
    

    <?php }else if($rol==2){ ?>

      <a href="../tratamiento/index.php" type="button"  class="btn btn-dark">Regresar</a>
    
    <?php }?>

    </div>

    </form>






    <?php include("../../templates/footer.php");?>