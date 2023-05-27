<?php 
include ("../../db.php");
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

include ("./config.php");

if($rol==2){
if(isset($_SESSION['correo'])) {
  $user_session = $_SESSION['correo'];
  
  // consulta para obtener el id del usuario
  $stmt = $conexion->prepare("SELECT idUser FROM users WHERE correo = ?");
  $stmt->execute([$user_session]);
  $row = $stmt->fetch();
  $idUser = $row['idUser'];

  $stmt = $conexion->prepare("SELECT idDoctor FROM doctor WHERE idUser = ?");
  $stmt->execute([$idUser]);
  $row = $stmt->fetch();
  $idDoctor = $row['idDoctor'];

  $sentencia=$con->prepare("SELECT * FROM `paciente`");
  $sentencia->execute();
  $lista_pacientes=$sentencia->get_result()->fetch_all(MYSQLI_ASSOC);

  $sentencia=$con->prepare("SELECT * FROM `doctor`
  WHERE idDoctor='$idDoctor'");
  $sentencia->execute();
  $lista_doctores=$sentencia->get_result()->fetch_all(MYSQLI_ASSOC);
  }

} else if($rol==1){

  $sentencia=$con->prepare("SELECT * FROM `paciente`");
  $sentencia->execute();
  $lista_pacientes=$sentencia->get_result()->fetch_all(MYSQLI_ASSOC);
  $sentencia3=$con->prepare("SELECT * FROM `doctor`");
  $sentencia3->execute();
  $lista_doctores2=$sentencia3->get_result()->fetch_all(MYSQLI_ASSOC);

}
  


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">


<div class="modal" id="exampleModal"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registrar Nueva Cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
  <form name="formEvento" id="formEvento" action="nuevoEvento.php" class="form-horizontal" method="POST">
		<div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="evento" id="evento" placeholder="Nombre del Evento" required/>
			</div>
		</div>
    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label">Fecha Inicio</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Inicio">
      </div>
    </div>
    <div class="form-group">
      <label for="fecha_fin" class="col-sm-12 control-label">Fecha Final</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha Final">
      </div>
    </div>

    <div class="form-group">
      <label for="horainicio" class="col-sm-4 control-label">Hora</label>
      <div class="col-sm-10">
        <input type="time" class="form-control" name="horainicio" id="horainicio" placeholder="Hora">
      </div>
    </div>

    

    <div class="form-group">
      <label for="modalidad" class="col-sm-4 control-label">Modalidad</label>
      <div class="col-sm-10">
      <select id="modalidad" name="modalidad" class="form-select">
      <option selected>Tipo</option>
      <option value="Presencial">Presencial </option>
      <option value="Virtual">Virtual </option>
      </select>
      </div>
    </div>

    <div class="form-group">
      <label for="linkAten" class="col-sm-4 control-label">Link de Atención</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="linkAten" id="linkAten" placeholder="Meet">
      </div>
    </div>

    
    <div class="form-group">
      <label for="hora" class="col-sm-4 control-label">Paciente: </label>
      <div class="col-sm-10">
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
    </div>

  
    
    <?php if($rol==2){?>
    <div class="form-group">
      <label for="hora" class="col-sm-4 control-label">Doctor: </label>
      <div class="col-sm-10">
      <select id="idDoctor" name="idDoctor" class="form-select">
    <option selected>Doctor</option>
    <?php foreach($lista_doctores as $doctor)            
    { ?>
       <option value="<?php echo $doctor['idDoctor']; ?>">
        <?php echo $doctor['nombres']; ?>
      </option>
      </option>
    <?php } ?>
    </select>
    </div>
    </div>

    <?php } else if($rol==1){?>

      <div class="form-group">
      <label for="hora" class="col-sm-4 control-label">Doctor: </label>
      <div class="col-sm-10">
      <select id="idDoctor" name="idDoctor" class="form-select">
    <option selected>Doctor</option>
    <?php foreach($lista_doctores2 as $doctor)            
    { ?>
       <option value="<?php echo $doctor['idDoctor']; ?>">
        <?php echo $doctor['nombres']; ?>
      </option>
      </option>
    <?php } ?>
    </select>
    </div>
    </div>


    <?php } ?>



  <div class="col-md-12" id="grupoRadio">
  
  <input type="radio" name="color_evento" id="amber" value="#FFC107">  
  <label for="amber" class="circu" style="background-color: #FFC107;"> </label>

  <input type="radio" name="color_evento" id="teal" value="#009688">  
  <label for="teal" class="circu" style="background-color: #009688;"> </label>

  <input type="radio" name="color_evento" id="indigo" value="#DF4268">  
  <label for="indigo" class="circu" style="background-color: #DF4268;"> </label>

</div>
		
	   <div class="modal-footer">
      	<button type="submit" class="btn btn-success">Guardar Evento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
    	</div>
	</form>
      
    </div>
  </div>
</div>