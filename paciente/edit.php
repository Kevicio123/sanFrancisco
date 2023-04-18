<?php 
include("../db.php");

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `examen` WHERE idExamen=:idExamen");
    $sentencia->bindParam(":idExamen",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $tipExamen=$registro["tipExamen"];
    $examen=$registro["examen"];
    $comentarios=$registro["comentarios"];
    $idTrat=$registro["idTrat"];
    $idPaciente=$registro["idPaciente"];

}

if($_POST){
  // Recolectamos los datos
  
  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  $tipExamen=(isset($_POST["tipExamen"])?$_POST["tipExamen"]:"");
  $comentarios=(isset($_POST["comentarios"])?$_POST["comentarios"]:"");
  $idTrat=(isset($_POST["idTrat"])?$_POST["idTrat"]:"");
  $idPaciente=(isset($_POST["idPaciente"])?$_POST["idPaciente"]:"");


  // Insertamos los datos a la BD
  $sentencia=$conexion->prepare
  ("UPDATE examen SET
  tipExamen=:tipExamen,
  comentarios=:comentarios,
  idTrat=:idTrat,
  idPaciente=:idPaciente
  WHERE idExamen=:idExamen");

  // Asignando los valores del formulario
  $sentencia->bindParam(":tipExamen",$tipExamen);
  $sentencia->bindParam(":comentarios",$comentarios);
  $sentencia->bindParam(":idTrat",$idTrat);
  $sentencia->bindParam(":idPaciente",$idPaciente);
  $sentencia->bindParam(":idExamen",$txtID);
  $sentencia->execute();
  
  // Edicion de Documento PDF
    $examen=(isset($_FILES["examen"]['name'])?$_FILES["examen"]['name']:"");

    $fecha= new DateTime();
    $nombreArchivo_examen=($examen!='')?$fecha->getTimestamp()."_".$_FILES['examen']['name']:"";

    $tmp_examen=$_FILES["examen"]['tmp_name'];

    if($tmp_examen!=''){
      move_uploaded_file($tmp_examen,"../secciones/examen/".$nombreArchivo_examen);
     
      // Buscar el archivo relacionado con el paciente
      
      $sentencia=$conexion->prepare("SELECT examen FROM `examen`
      WHERE idExamen=:idExamen");
      $sentencia->bindParam(":idExamen",$txtID);
      $sentencia->execute();
      $encontrar_pdf=$sentencia->fetch(PDO::FETCH_LAZY);

      // Borrar el archivo
      if(isset($encontrar_pdf["examen"]) && $encontrar_pdf["examen"]!="" ){
        if(file_exists("./".$encontrar_pdf["examen"])){
            unlink("./".$encontrar_pdf["examen"] );         
        }
      } 

      $sentencia=$conexion->prepare("UPDATE examen SET examen=:examen
      WHERE idExamen=:idExamen");
      $sentencia->bindParam(":examen",$nombreArchivo_examen);
      $sentencia->bindParam(":idExamen",$txtID);
      $sentencia->execute();

    }

    $mensaje="Examen Enviado";
    header("Location:examen.php?mensaje=".$mensaje);
  

}

  $sentencia=$conexion->prepare("SELECT * FROM `paciente`");
  $sentencia->execute();
  $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

  $sentencia=$conexion->prepare("SELECT * FROM `tratamiento`");
  $sentencia->execute();
  $lista_tratamientos=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>


<?php include("../templates/Paciente/header.php");?>
    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Enviar Exámen Médico</h3>

    <div class="col-md-4" hidden>
    <label for="idExamen" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="txtID" name="txtID">
    </div>

    <div class="col-md-4" class="visually-focusable" style="pointer-events: none;">
    <label for="tipExamen" class="form-label">Nombre del Examen</label>
    <input class="form-control" value="<?php echo $tipExamen;?>" id="tipExamen" name="tipExamen">
    
    </div>
    
    <div class="col-md-4">
    <label for="idTrat" class="form-label">Nombre del Tratamiento</label>
    <select id="idTrat" name="idTrat" class="form-select">
    <option selected>Usuario</option>
    <?php foreach($lista_tratamientos as $tratamiento)            
    { ?>
      <option <?php echo($idTrat==$tratamiento['idTrat'])?"selected":"";?>
      value="<?php echo $tratamiento['idTrat']; ?>">
        <?php echo $tratamiento['nomTrata']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    <div class="col-md-4" style="pointer-events: none;">
    <label for="idPaciente" class="form-label">Paciente Tratante</label>
    <select id="idPaciente" name="idPaciente" class="form-select">
    <?php foreach($lista_pacientes as $paciente)            
    { ?>
      <option <?php echo($idPaciente==$paciente['idPaciente'])?"selected":"";?>
      value="<?php echo $paciente['idPaciente']; ?>">
        <?php echo $paciente['dni']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    <div class="col-md-8" style="pointer-events: none;">
    <label for="comentarios" class="form-label">Comentarios</label>
    <input type="text" value="<?php echo $comentarios;?>" class="form-control" id="comentarios" name="comentarios">
    </div>


    <div class="col-md-4">
    <label for="examen" class="form-label">Adjunte el Examen: (Imagen)</label>
    <input type="file" value="<?php echo $examen;?>" class="form-control" id="examen" name="examen" >
    Archivo: <a target="_blank" href="<?php echo $examen;?>"><?php echo $examen;?></a>
    </div>

   

    

    <div class="col-12">
    <button type="submit" class="btn btn-primary">Enviar</button>
    <a href="examen.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>

    </form>






    <?php include("../templates/Paciente/footer.php");?>