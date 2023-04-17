<?php

include("../db.php");
    session_start();
    
    $user_session=$_SESSION['correo'];
    $paciente = $conexion->prepare
    ("SELECT *,
    (SELECT idUser FROM paciente WHERE users.IdUser=paciente.IdUser) AS id
     FROM users WHERE correo = '$user_session'");
     $paciente->execute();
     $pacientes=$paciente->fetchAll(PDO::FETCH_ASSOC);
    
     foreach( $pacientes as $paciente){
        $id=$paciente['id'];
     }

    $sentencia=$conexion->prepare("SELECT *
    FROM `atencion` a 
    INNER JOIN `paciente` p ON a.idPaciente =p.idPaciente
    INNER JOIN `doctor` d ON a.idDoctor = d.idDoctor
    WHERE p.idUser =$id");
    $sentencia->execute();
    $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $n=0;

?>

<?php
$url_base="http://localhost/proySanFranciscoPHP/";

?>

<?php include("../templates/Paciente/header.php");?>

    <br>
    
    <h2 align="center">Sección de Atenciones Médicas</h2>

    <br>

    <div class="alert alert-dismissible alert-primary">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Sección de Atenciones y Reuniones!</strong> En esta sección podrá visualizar
    las atenciones médicas realizadas a lo largo del tratamiento del paciente.
    </div>
  
    <table class="table table-striped table-hover" id="tabla">
    <thead>
      <tr>
        <th scope="col"></th>
      </tr>
    </thead>
    <tfoot>
    <?php foreach ($lista_pacientes as $paciente) { ?>
      <tr>
        <td> 
          <div class="card">
            <div class="card-body">
              <div class="p-3 mb-2 bg-primary text-white"><h5 class="card-title">Atención Médica vía Google Meet <?php if(true){echo $n=$n+1;};?></h5></div>
              <div class="p-3 mb-2 bg-light text-dark">
                <p class="card-text"><b>Fecha de la Reunión:</b> <?php echo $paciente['fechAten']?></p>
                <p class="card-text"><b>Médico Tratante:</b> <?php echo $paciente['nombres']?></p>
                <?php if ($paciente['estado'] == "Culminado") { ?>
                  <b>Estado: <p class="text-success"><?php echo $paciente['estado']; ?></p></b>
                <?php } else { ?> 
                  <b>Estado: <p class="text-danger"><?php echo $paciente['estado']; ?></p></b> 
                <?php } ?>
              </div>
              <a href="detalle.php?txtID=<?php echo $paciente['idAtencion']; ?>" class="btn btn-dark">Detalle</a>
            </div>
          </div>
        </td>
      </tr>
    </tfoot>
    <?php } ?>
    </table>




    <?php include("../templates/Paciente/footer.php");?> 



