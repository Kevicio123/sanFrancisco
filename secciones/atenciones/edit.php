<?php 
include ("../../db.php");

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `atencion` 
    WHERE idAtencion=:idAtencion");
    $sentencia->bindParam(":idAtencion",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $fechAten=$registro["fechAten"];
    $linkAten=$registro["linkAten"];
    $Comentarios=$registro["Comentarios"];
    $estado=$registro["estado"];
    $asistencia=$registro["asistencia"];
    $modalidad=$registro["modalidad"];
    $idDoctor=$registro["idDoctor"];
    $idPaciente=$registro["idPaciente"];
}

// Intrucción de recolección de datos

if($_POST){
    // Recolectamos los datos
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $fechAten=(isset($_POST["fechAten"])?$_POST["fechAten"]:"");
    $linkAten=(isset($_POST["linkAten"])?$_POST["linkAten"]:"");
    $Comentarios=(isset($_POST["Comentarios"])?$_POST["Comentarios"]:"");
    $estado=(isset($_POST["estado"])?$_POST["estado"]:"");
    $asistencia=(isset($_POST["asistencia"])?$_POST["asistencia"]:"");
    $modalidad=(isset($_POST["modalidad"])?$_POST["modalidad"]:"");
    $idDoctor=(isset($_POST["idDoctor"])?$_POST["idDoctor"]:"");
    $idPaciente=(isset($_POST["idPaciente"])?$_POST["idPaciente"]:"");


    // Actualizamos los datos de la BD
    $sentencia=$conexion->prepare
  ("UPDATE atencion SET
  fechAten=:fechAten,
  linkAten=:linkAten,
  Comentarios=:Comentarios,
  estado=:estado,
  asistencia=:asistencia,
  modalidad=:modalidad,
  idDoctor=:idDoctor,
  idPaciente=:idPaciente
  WHERE idAtencion=:idAtencion");

 
    // Asignando los valores del formulario
    $sentencia->bindParam(":fechAten",$fechAten);
    $sentencia->bindParam(":linkAten",$linkAten);
    $sentencia->bindParam(":Comentarios",$Comentarios);
    $sentencia->bindParam(":estado",$estado);
    $sentencia->bindParam(":asistencia",$asistencia);
    $sentencia->bindParam(":modalidad",$modalidad);
    $sentencia->bindParam(":idDoctor",$idDoctor);
    $sentencia->bindParam(":idPaciente",$idPaciente);
    $sentencia->bindParam(":idAtencion",$txtID);
    $sentencia->execute();

    $mensaje="Reunión Actualizada correctamente";
    header("Location:index.php?mensaje=".$mensaje);
}

  $sentencia=$conexion->prepare("SELECT * FROM `paciente`");
  $sentencia->execute();
  $pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

  $sentencia=$conexion->prepare("SELECT * FROM `doctor`");
  $sentencia->execute();
  $doctores=$sentencia->fetchAll(PDO::FETCH_ASSOC);


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
    <br>
    <br>


<form action="" method="post" class="row g-3" enctype="multipart/form-data">

<h3>Crear Atención Médica</h3>

<div class="col-md-4" hidden>
    <label for="idAtencion" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="txtID" name="txtID">
    </div>


<div class="col-md-6">
<label for="idPaciente" class="form-label">Paciente Tratante</label>
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

<div class="col-md-6">
<label for="idDoctor" class="form-label">Médico Tratante</label>
<select name="idDoctor" id="idDoctor" class="form-select">

    <?php foreach($doctores as $doctor)            
    { ?>
    <option <?php echo($idDoctor==$doctor['idDoctor'])?"selected":"";?>
      value="<?php echo $doctor['idDoctor']; ?>">
        <?php echo $doctor['nombres']; ?>
      </option>
    
    <?php } ?>
</select>
</div>


<div class="col-md-12" disabled="true">
<label for="Comentarios" class="form-label">Comentarios</label>
<input type="text" class="form-control" id="Comentarios" name="Comentarios"
value="<?php echo $Comentarios?>">
</div>


<div class="col-md-4" disabled="true">
<label for="fechAten" class="form-label">Fecha de Reunión</label>
<input type="date" class="form-control" id="fechAten" name="fechAten"
value="<?php echo $fechAten?>">
</div>


<div class="col-md-8" disabled="true">
<label for="linkAten" class="form-label">Link de Reunión</label>
<input type="text" class="form-control" id="linkAten" name="linkAten"
value="<?php echo $linkAten?>">
</div>

<div class="col-md-4">
    <label for="estado" class="form-label">Estado</label>
    <select id="estado" name="estado" class="form-select">
      <option value="<?php echo $estado?>"><?php echo $estado?></option>
      <option value="Pendiente">Pendiente</option>
      <option value="Terminado">Terminado</option>
    </select>
    </div>

    <div class="col-md-4">
    <label for="asistencia" class="form-label">Asistencia</label>
    <select id="asistencia" name="asistencia" class="form-select">
      <option value="<?php echo $asistencia?>"><?php echo $asistencia?></option>
      <option value="Asistido">Asistió</option>
      <option value="Inasistencia">No Asistió</option>
    </select>
    </div>


    <div class="col-md-4">
    <label for="modalidad" class="form-label">Modalidad</label>
    <select id="modalidad" name="modalidad" class="form-select">
    <option value="<?php echo $modalidad?>"><?php echo $modalidad?></option>
      <option value="Virtual">Virtual</option>
      <option value="Presencial">Presencial</option>
    </select>
    </div>








<div class="col-12">
<button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="../atenciones/index.php" type="button"  class="btn btn-dark">Regresar</a>
</div>

</form>


<?php include("../../templates/footer.php");?>