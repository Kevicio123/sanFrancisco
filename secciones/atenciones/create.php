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
    $fechAten=(isset($_POST["fechAten"])?$_POST["fechAten"]:"");
    $hora=(isset($_POST["hora"])?$_POST["hora"]:"");
    $linkAten=(isset($_POST["linkAten"])?$_POST["linkAten"]:"");
    $Comentarios=(isset($_POST["Comentarios"])?$_POST["Comentarios"]:"");
    $estado=(isset($_POST["estado"])?$_POST["estado"]:"");
    $asistencia=(isset($_POST["asistencia"])?$_POST["asistencia"]:"");
    $modalidad=(isset($_POST["modalidad"])?$_POST["modalidad"]:"");
    $idDoctor=(isset($_POST["idDoctor"])?$_POST["idDoctor"]:"");
    $idPaciente=(isset($_POST["idPaciente"])?$_POST["idPaciente"]:"");

    // Insertamos los datos a la BD
    $sentencia=$conexion->prepare("INSERT INTO atencion(idAtencion,fechAten,hora,linkAten,Comentarios,estado,asistencia,modalidad,idDoctor,idPaciente)
            VALUES(null,:fechAten,:hora,:linkAten,:Comentarios,:estado,:asistencia,:modalidad,:idDoctor,:idPaciente)");

    // Asignando los valores del formulario
    $sentencia->bindParam(":fechAten",$fechAten);
    $sentencia->bindParam(":hora",$hora);
    $sentencia->bindParam(":linkAten",$linkAten);
    $sentencia->bindParam(":Comentarios",$Comentarios);
    $sentencia->bindParam(":estado",$estado);
    $sentencia->bindParam(":asistencia",$asistencia);
    $sentencia->bindParam(":modalidad",$modalidad);
    $sentencia->bindParam(":idDoctor",$idDoctor);
    $sentencia->bindParam(":idPaciente",$idPaciente);
    $sentencia->execute();
    if($rol==1){ 
    $mensaje="Atención Creada Correctamente";
    header("Location:index.php?mensaje=".$mensaje);
    }else if(rol==2){
    $mensaje="Atención Creada Correctamente";
    header("Location:../../doctor/?mensaje=".$mensaje); 
    }
}

$sentencia=$conexion->prepare("SELECT * FROM `paciente`");
$sentencia->execute();
$lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM `doctor`");
$sentencia->execute();
$lista_doctores=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>


    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Crear Atención Médica</h3>

    <div class="col-md-6">
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

    <div class="col-md-6">
    <label for="idDoctor" class="form-label">Médico Tratante</label>
    <select name="idDoctor" id="idDoctor" class="form-select">
    <option selected>Doctor</option>
        <?php foreach($lista_doctores as $doctor)            
        { ?>
    <option value="<?php echo $doctor['idDoctor']; ?>">
        <?php echo $doctor['nombres']; ?>
    </option>
        <?php } ?>
    </select>
    </div>


    <div class="col-md-12" disabled="true">
    <label for="Comentarios" class="form-label">Comentarios</label>
    <input type="text" class="form-control" id="Comentarios" name="Comentarios">
    </div>

    <div class="col-md-4" disabled="true">
    <label for="fechAten" class="form-label">Fecha de Reunión</label>
    <input type="date" class="form-control" id="fechAten" name="fechAten">
    </div>

    <div class="col-md-4" disabled="true">
    <label for="hora" class="form-label">Hora de Reunión</label>
    <input type="time" class="form-control" id="hora" name="hora">
    </div>

    <div class="col-md-4" disabled="true">
    <label for="linkAten" class="form-label">Link de Reunión</label>
    <input type="text" class="form-control" id="linkAten" name="linkAten">
    </div>

    <div class="col-md-4">
    <label for="estado" class="form-label">Estado</label>
    <select id="estado" name="estado" class="form-select">
      <option value="Pendiente">Pendiente</option>
      <option value="Terminado">Terminado</option>
    </select>
    </div>

    <div class="col-md-4">
    <label for="asistencia" class="form-label">Asistencia</label>
    <select id="asistencia" name="asistencia" class="form-select">
    <option value="">Seleccione</option>
      <option value="Asistido">Asistió</option>
      <option value="Inasistencia">No Asistió</option>
    </select>
    </div>

    <div class="col-md-4">
    <label for="asistencia" class="form-label">Modalidad</label>
    <select id="modalidad" name="modalidad" class="form-select">
    <option value="">Seleccione</option>
      <option value="Virtual">Virtual</option>
      <option value="Presencial">Presencial</option>
    </select>
    </div>




    




    <div class="col-12">
    <button type="submit" class="btn btn-primary">Enviar</button>
    <?php if($rol==1){?>
    <a href="../atenciones/index.php" type="button"  class="btn btn-dark">Regresar</a>
    <?php }else if($rol==2){ ?>
    <a href="../../doctor/index.php" type="button"  class="btn btn-dark">Regresar</a>
    <?php }?>

    </div>

    </form>
    





<?php include("../../templates/footer.php");?>