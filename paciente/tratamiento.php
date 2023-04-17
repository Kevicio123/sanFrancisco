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
    FROM `tratamiento` t 
    INNER JOIN `paciente` p ON t.idPaciente =p.idPaciente
    INNER JOIN `tiposervicio` u ON t.idTipSer = u.idTipSer
    WHERE p.idUser =$id");
    $sentencia->execute();
    $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia2=$conexion->prepare("SELECT *
    FROM `tratamiento` t 
    INNER JOIN `paciente` p ON t.idPaciente =p.idPaciente
    INNER JOIN `doctor` d ON d.idDoctor =t.idDoctor
    WHERE p.idUser =$id");
    $sentencia2->execute();
    $doctores=$sentencia2->fetchAll(PDO::FETCH_ASSOC);

    foreach( $doctores as $doctor){
        $doc=$doctor['nombres'].' '.$doctor['apePat'].' '.$doctor['apaeMat'];
     }
    

?>

<?php
$url_base="http://localhost/proySanFranciscoPHP/";

?>
<?php include("../templates/Paciente/header.php");?>
    <br>
    
    <h2 align="center">Sección de Tratamientos</h2>

    <br>

    <div class="alert alert-dismissible alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Sección de Tratamientos!</strong> En esta sección podrá visualizar
    las atenciones y exámenes médicos realizados a lo largo de su tratamiento.
    </div>
    <?php foreach($lista_pacientes as $paciente) 
                
     { ?>

    
  
  <div class="card" >
  <div class="card-body">
    <div class="p-3 mb-2 bg-primary text-white"><h5 class="card-title">Tratamiento en Curso: <?php echo $paciente['nomTrata'];?></h5></div>
    <div class="p-3 mb-2 bg-light text-dark">
    <h6 class="card-subtitle mb-2 text-muted"><b>Paciente:</b> <?php echo $paciente['nombres']?></h6>
    
    <p class="card-text"><b>Servicio:</b> <?php echo $paciente['nomSer']?></p>
    <p class="card-text"><b>Médico Tratante:</b> <?php echo $doc?></p>
    <p class="card-text"><b>Estado:</b> <?php echo $paciente['estadoTratamiento']?></p>
    </div>
   
    <a href="atenciones.php" class="btn btn-dark">Atenciones</a>
    <a href="examen.php" class="btn btn-primary">Exámenes</a>
    
    <br>
    <br>
  </div>
  </div>

    
<br>
<br>
<?php } ?>

        
    <?php include("../templates/Paciente/footer.php");?>