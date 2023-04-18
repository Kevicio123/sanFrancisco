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

    
    
  
  
    <div class="row">
    <?php foreach ($lista_pacientes as $paciente) { ?>

      <?php if ($paciente['estado'] == "Culminado") { ?>
    <div class="col-md-4">
      <div class="card" style="width: 20rem;">
        <div class="card-body">
          <div class="p-3 mb-2 bg-success text-white"><h5 class="card-title">Atención Médica <?php if(true){echo $n=$n+1;};?></h5></div>
          <div class="p-3 mb-2 bg-light text-dark">
                <?php
                setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es'); // establece la configuración regional en español
                $fecha = $paciente['fechAten']; // fecha de ejemplo en formato ISO
                $timestamp = strtotime($fecha);
                $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                ?>

                <?php
                $hora = $paciente['hora']; // ejemplo de dato de tipo time
                $hora_am_pm = date("h:i A", strtotime($hora));
                ?>

            <p class="card-title"><b>Fecha de la Reunión:</b> <?php echo $fecha_formateada;?></p>
            <p class="card-title"><b>Hora:</b> <?php echo $hora_am_pm;?></p>
            <p class="card-title"><b>Médico Tratante:</b> <?php echo $paciente['nombres']?></p>
            <p class="card-title"><b>Modalidad:</b> <?php echo $paciente['modalidad']?></p>
            <?php if ($paciente['estado'] == "Culminado") { ?>
              <p class="card-title"> <b>Estado: <p class="text-success"><?php echo $paciente['estado']; ?></p></b> </p>
            <?php } else { ?> 
              <p class="card-title"> <b>Estado: <p class="text-danger"><?php echo $paciente['estado']; ?></p></b> </p>
            <?php } ?>
          </div>
          <a href="detalle.php?txtID=<?php echo $paciente['idAtencion']; ?>" class="btn btn-dark">Detalle</a>
        </div>
      </div>
      <br>
    </div>
    <?php } else{  ?> 
      <div class="col-md-4">
      <div class="card" style="width: 20rem;">
        <div class="card-body">
          <div class="p-3 mb-2 bg-danger text-white"><h5 class="card-title">Atención Médica <?php if(true){echo $n=$n+1;};?></h5></div>
          <div class="p-3 mb-2 bg-light text-dark">
                <?php
                setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es'); // establece la configuración regional en español
                $fecha = $paciente['fechAten']; // fecha de ejemplo en formato ISO
                $timestamp = strtotime($fecha);
                $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                ?>
                <?php
                $hora = $paciente['hora']; // ejemplo de dato de tipo time
                $hora_am_pm = date("h:i A", strtotime($hora));
                ?>
            <p class="card-title"><b>Fecha de la Reunión:</b> <?php echo $fecha_formateada;?></p>
            <p class="card-title"><b>Hora:</b> <?php echo $hora_am_pm;?></p>
            <p class="card-title"><b>Médico Tratante:</b> <?php echo $paciente['nombres']?></p>
            <p class="card-title"><b>Modalidad:</b> <?php echo $paciente['modalidad']?></p>
            <?php if ($paciente['estado'] == "Culminado") { ?>
              <p class="card-title"> <b>Estado: <p class="text-success"><?php echo $paciente['estado']; ?></p></b> </p>
            <?php } else { ?> 
              <p class="card-title"> <b>Estado: <p class="text-danger"><?php echo $paciente['estado']; ?></p></b> </p>
            <?php } ?>
          </div>
          <a href="detalle.php?txtID=<?php echo $paciente['idAtencion']; ?>" class="btn btn-dark">Detalle</a>
        </div>
      </div>
      <br>
    </div>
    <?php } ?>
    <?php } ?>
  </div>
    

    <a href="tratamiento.php" class="btn btn-success">Regresar</a>




    <?php include("../templates/Paciente/footer.php");?> 



