
<?php
include ("../../db.php");

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `paciente` 
    WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $dni=$registro["dni"];
    
}

if($_POST){

    // Recolectamos los datos
    $odontograma=(isset($_FILES["odontograma"]['name'])?$_FILES["odontograma"]['name']:"");
    $moldeDental=(isset($_FILES["moldeDental"]['name'])?$_FILES["moldeDental"]['name']:"");
    $intraoral=(isset($_FILES["intraoral"]['name'])?$_FILES["intraoral"]['name']:"");
    $rostro=(isset($_FILES["rostro"]['name'])?$_FILES["rostro"]['name']:"");
    $idPaciente=(isset($_POST['txtID'])?$_POST['txtID']:"");
    $idTrat=(isset($_POST['idTrat'])?$_POST['idTrat']:"");

    $sentencia=$conexion->prepare
    ("INSERT INTO repositorio(idRepo,odontograma,moldeDental,intraoral,rostro,idPaciente,idTrat)
    VALUES (null,:odontograma,:moldeDental,:intraoral,:rostro,:idPaciente,:idTrat)");

    $fecha= new DateTime();

    $nombreArchivo1=($odontograma!='')?$fecha->getTimestamp()."_".$_FILES['odontograma']['name']:"";
    $tmp_archivo1=$_FILES["odontograma"]['tmp_name'];
    if($tmp_archivo1!=''){
        move_uploaded_file($tmp_archivo1,"../documentos/".$nombreArchivo1);
      }

    $nombreArchivo2=($moldeDental!='')?$fecha->getTimestamp()."_".$_FILES['moldeDental']['name']:"";
    $tmp_archivo2=$_FILES["moldeDental"]['tmp_name'];
    if($tmp_archivo2!=''){
        move_uploaded_file($tmp_archivo2,"../documentos/".$nombreArchivo2);
      }

    $nombreArchivo3=($intraoral!='')?$fecha->getTimestamp()."_".$_FILES['intraoral']['name']:"";
    $tmp_archivo3=$_FILES["intraoral"]['tmp_name'];
    if($tmp_archivo3!=''){
        move_uploaded_file($tmp_archivo3,"../documentos/".$nombreArchivo3);
      }
  
    $nombreArchivo4=($rostro!='')?$fecha->getTimestamp()."_".$_FILES['rostro']['name']:"";
    $tmp_archivo4=$_FILES["rostro"]['tmp_name'];
    if($tmp_archivo4!=''){
        move_uploaded_file($tmp_archivo4,"../documentos/".$nombreArchivo4);
      }
  
    $sentencia->bindParam(":odontograma",$nombreArchivo1);
    $sentencia->bindParam(":moldeDental",$nombreArchivo2);
    $sentencia->bindParam(":intraoral",$nombreArchivo3);
    $sentencia->bindParam(":rostro",$nombreArchivo4);
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->bindParam(":idTrat",$idTrat);
    $sentencia->execute();
    $mensaje="Archivos Subidos correctamente";
    header("Location:index.php?mensaje=".$mensaje);
    

    }

    $sentencia=$conexion->prepare("SELECT * FROM `tratamiento`
    WHERE idPaciente='$txtID'");
    $sentencia->execute();
    $lista_tratamiento=$sentencia->fetchAll(PDO::FETCH_ASSOC);
  


?>

<?php

    include("../../templates/Doctor/header.php");
    
?>

    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Subir Archivos del Paciente</h3>

    <div class="col-md-4" hidden>
    <label for="idPaciente" class="form-label">idPaciente</label>
    <input value="<?php echo $idPaciente;?>"
    type="text" class="form-control" id="idPaciente" name="idPaciente">
    </div>

    <div class="col-md-6">
    <label for="dni" class="form-label">DNI</label>
    <input type="char" class="form-control" id="dni" name="dni" value="<?php echo $dni;?>" readonly>
    </div>

    <div class="col-6">
    <label for="idTrat" class="form-label">Tratamiento</label>
    <select id="idTrat" name="idTrat" class="form-select" required>
    <option selected>Tratamiento</option>
    <?php foreach($lista_tratamiento as $tratamiento)            
    { ?>
      <option value="<?php echo $tratamiento['idTrat']; ?>">
        <?php echo $tratamiento['nomTrata']; ?>
      </option>
    <?php } ?>
    </select>
    </div>


    <div class="col-md-4">
    <label for="odontograma" class="form-label">Adjunte Imagen Odontograma: </label>
    <input type="file" class="form-control" id="odontograma" name="odontograma" >
    </div>

    <div class="col-md-4">
    <label for="moldeDental" class="form-label">Adjunte Imagen Molde Dental:</label>
    <input type="file" class="form-control" id="moldeDental" name="moldeDental" >
    </div>

    <div class="col-md-4">
    <label for="intraoral" class="form-label">Adjunte Imágenes Intraorales:</label>
    <input type="file" class="form-control" id="intraoral" name="intraoral" >
    </div>

    <div class="col-md-4">
    <label for="rostro" class="form-label">Adjunte Imágenes de Rostro:</label>
    <input type="file" class="form-control" id="rostro" name="rostro" >
    </div>


    <div class="col-12">
    <button type="submit" class="btn btn-success">Registrar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>

    </form>

  






<?php include("../../templates/footer.php");?>