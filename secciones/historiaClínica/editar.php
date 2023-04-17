<?php
include ("../../db.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `historiaclinica` WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $idHistoria=$registro['idHistoria'];
    $idPaciente=$registro["idPaciente"];
    $motivoConsulta=$registro["motivoConsulta"];
    $enfermedad=$registro["enfermedad"];
    $inicio=$registro["inicio"];
    $fin=$registro["fin"];
    $p1=$registro["p1"];
    $p2=$registro["p2"];
    $p3=$registro["p3"];
    $p4=$registro["p4"];
    $p5=$registro["p5"];
    $p6=$registro["p6"];
    $p7=$registro["p7"];
    $p8=$registro["p8"];
    $p9=$registro["p9"];
    $p10=$registro["p10"];
    $p11=$registro["p11"];
    $p12=$registro["p12"];
    $p13=$registro["p13"];
    $p14=$registro["p14"];
    $p15=$registro["p15"];
    $p16=$registro["p16"];

    
    $sentencia2=$conexion->prepare("SELECT * FROM `paciente` WHERE idPaciente=:idPaciente");
    $sentencia2->bindParam(":idPaciente",$txtID);
    $sentencia2->execute();
    $registro2=$sentencia2->fetch(PDO::FETCH_LAZY);

    $nombreCompleto= $registro2['nombres'].' '.$registro2['apePat'].' '.$registro2['apaeMat'];
   
}


if($_POST){

    $idHistoria=(isset($_POST["idHistoria"])?$_POST["idHistoria"]:"");
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $motivoConsulta=(isset($_POST["motivoConsulta"])?$_POST["motivoConsulta"]:"");
    $enfermedad=(isset($_POST["enfermedad"])?$_POST["enfermedad"]:"");
    $inicio=(isset($_POST["inicio"])?$_POST["inicio"]:"");
    $fin=(isset($_POST["fin"])?$_POST["fin"]:"");
    $p1=(isset($_POST["p1"])?$_POST["p1"]:"");
    $p2=(isset($_POST["p2"])?$_POST["p2"]:"");
    $p3=(isset($_POST["p3"])?$_POST["p3"]:"");
    $p4=(isset($_POST["p4"])?$_POST["p4"]:"");
    $p5=(isset($_POST["p5"])?$_POST["p5"]:"");
    $p6=(isset($_POST["p6"])?$_POST["p6"]:"");
    $p7=(isset($_POST["p7"])?$_POST["p7"]:"");
    $p8=(isset($_POST["p8"])?$_POST["p8"]:"");
    $p9=(isset($_POST["p9"])?$_POST["p9"]:"");
    $p10=(isset($_POST["p10"])?$_POST["p10"]:"");
    $p11=(isset($_POST["p11"])?$_POST["p11"]:"");
    $p12=(isset($_POST["p12"])?$_POST["p12"]:"");
    $p13=(isset($_POST["p13"])?$_POST["p13"]:"");
    $p14=(isset($_POST["p14"])?$_POST["p14"]:"");
    $p15=(isset($_POST["p15"])?$_POST["p15"]:"");
    $p16=(isset($_POST["p16"])?$_POST["p16"]:"");

     // Actualizamos los datos de la BD
     $sentencia=$conexion->prepare
     ("UPDATE historiaclinica SET
     idHistoria=:idHistoria,
     idPaciente=:idPaciente,
     motivoConsulta=:motivoConsulta,
     enfermedad=:enfermedad,
     inicio=:inicio,
     fin=:fin,
     p1=:p1,
     p2=:p2,
     p3=:p3,
     p4=:p4,
     p5=:p5,
     p6=:p6,
     p7=:p7,
     p8=:p8,
     p9=:p9,
     p10=:p10,
     p11=:p11,
     p12=:p12,
     p13=:p13,
     p14=:p14,
     p15=:p15,
     p16=:p16
     WHERE idHistoria=:idHistoria");

    $sentencia->bindParam(":idHistoria",$idHistoria);
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->bindParam(":motivoConsulta",$motivoConsulta);
    $sentencia->bindParam(":enfermedad",$enfermedad);
    $sentencia->bindParam(":inicio",$inicio);
    $sentencia->bindParam(":fin",$fin);
    $sentencia->bindParam(":p1",$p1);
    $sentencia->bindParam(":p2",$p2);
    $sentencia->bindParam(":p3",$p3);
    $sentencia->bindParam(":p4",$p4);
    $sentencia->bindParam(":p5",$p5);
    $sentencia->bindParam(":p6",$p6);
    $sentencia->bindParam(":p7",$p7);
    $sentencia->bindParam(":p8",$p8);
    $sentencia->bindParam(":p9",$p9);
    $sentencia->bindParam(":p10",$p10);
    $sentencia->bindParam(":p11",$p11);
    $sentencia->bindParam(":p12",$p12);
    $sentencia->bindParam(":p13",$p13);
    $sentencia->bindParam(":p14",$p14);
    $sentencia->bindParam(":p15",$p15);
    $sentencia->bindParam(":p16",$p16);
    $sentencia->execute();
    $mensaje="Historia clínica actualizada correctamente";
    header("Location:index.php?mensaje=".$mensaje);




}






?>


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
<br>
<h3 align="center">Actualizar Historia Clínica</h3>


<form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <div class="col-md-12">
        <div class="alert alert-light" role="alert">
        <p><b>Paciente</b> <?php echo $nombreCompleto?> </p>
        </div>
    </div>

    <div class="">
    <label for="idHistoria" class="form-label">ID</label>
    <input value="<?php echo $idHistoria;?>"
    type="text" class="form-control" id="idHistoria" name="idHistoria">
    </div>

    <div class="">
    <label for="txtID" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="txtID" name="txtID">
    </div>

    <div class="col-12">
    <label for="motivoConsulta" class="form-label">Motivo de Consulta</label>
    <input type="text"  value="<?php echo isset($motivoConsulta)?$motivoConsulta:"";?>"
    class="form-control" id="motivoConsulta" name="motivoConsulta">
    </div>

    <div class="col-12">
    <label for="enfermedad" class="form-label">Enfermedad Actual</label>
    <input type="text"  value="<?php echo $enfermedad;?>"
    class="form-control" id="enfermedad" name="enfermedad">
    </div>

    <label><b> Tiempo de Enfermedad </b></label>
    <div class="col-4">
    <label for="inicio" class="form-label">Inicio</label>
    <input type="date"  value="<?php echo $inicio;?>"
    class="form-control" id="inicio" name="inicio">
    </div>

    <div class="col-4">
    <label for="fin" class="form-label">Fin/ Curso</label>
    <input type="date"  value="<?php echo $fin;?>"
    class="form-control" id="fin" name="fin">
    </div>

    <hr>

    <label><b> Signos y Síntomas principales </b></label>

    <div class="col-4">
    <label for="p1" class="form-label">¿Está bajo tratamiento médico?</label>
    <br>
    <input type="radio" id="p1" name="p1" value="Si" <?php echo ($registro['p1'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p1">Sí</label>
    <input type="radio" id="p1" name="p1" value="No" <?php echo ($registro['p1'] == 'No') ? 'checked' : ''; ?>>
    <label for="p1">No</label>
    </div>

    <div class="col-4">
    <label for="p2" class="form-label">¿Toma actualmente medicamentos?</label>
    <br><input type="radio" id="p2" name="p2" value="Si" <?php echo ($registro['p2'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p2">Sí</label>
    <input type="radio" id="p2" name="p2" value="No" <?php echo ($registro['p2'] == 'No') ? 'checked' : ''; ?>>
    <label for="p2">No</label>
    </div>


    <div class="col-4">
    <label for="p3" class="form-label">¿Qué medicamentos toma?</label>
    <input type="text"  class="form-control" id="p3" name="p3" value="<?php echo $p3?>">
    </div>

    <div class="col-4">
    <label for="p4" class="form-label">¿Le han realizado alguna intervención 
    quirúrgica?</label>
    <br>
    <input type="radio" id="p4" name="p4" value="Si" <?php echo ($registro['p4'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p4">Sí</label>
    <input type="radio" id="p4" name="p4" value="No" <?php echo ($registro['p4'] == 'No') ? 'checked' : ''; ?>>
    <label for="p4">No</label>
    </div>

    <div class="col-4">
    <label for="p5" class="form-label">¿Es alergico a algún medicamento?</label>
    <br>
    <input type="radio" id="p5" name="p5" value="Si" <?php echo ($registro['p5'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p5">Sí</label>
    <input type="radio" id="p5" name="p5" value="No" <?php echo ($registro['p5'] == 'No') ? 'checked' : ''; ?>>
    <label for="p5">No</label>
    </div>

    <div class="col-4">
    <label for="p13" class="form-label">¿A qué medicamentos es alergico?</label>
    <input type="text"  class="form-control" id="p13" name="p13" value="<?php echo $p13?>">
    </div>

    <div class="col-4">
    <label for="p6" class="form-label">¿Ha recibido alguna transfusión sanguínea? </label>
    <br>
    <input type="radio" id="p6" name="p6" value="Si" <?php echo ($registro['p6'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p6">Sí</label>
    <input type="radio" id="p6" name="p6" value="No" <?php echo ($registro['p6'] == 'No') ? 'checked' : ''; ?>>
    <label for="p6">No</label>
    </div>

    <div class="col-4">
    <label for="p7" class="form-label">¿Está embarazada? </label>
    <br>
    <input type="radio" id="p7" name="p7" value="Si" <?php echo ($registro['p7'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p7">Sí</label>
    <input type="radio" id="p7" name="p7" value="No" <?php echo ($registro['p7'] == 'No') ? 'checked' : ''; ?>>
    <label for="p7">No</label>
    </div>

    <div class="col-4">
    <label for="p8" class="form-label">¿Está tomando actualmente 
    anticonceptivos? </label>
    <br>
    <input type="radio" id="p8" name="p8" value="Si" <?php echo ($registro['p8'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p8">Sí</label>
    <input type="radio" id="p8" name="p8" value="No" <?php echo ($registro['p8'] == 'No') ? 'checked' : ''; ?>>
    <label for="p8">No</label>
    </div>

    <div class="col-4">
    <label for="p9" class="form-label">¿Fuma? </label>
    <br>
    <input type="radio" id="p9" name="p9" value="Si" <?php echo ($registro['p9'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p9">Sí</label>
    <input type="radio" id="p9" name="p9" value="No" <?php echo ($registro['p9'] == 'No') ? 'checked' : ''; ?>>
    <label for="p9">No</label>
    </div>

    <div class="col-4">
    <label for="p10" class="form-label">¿Cuantas veces se lava los dientes? </label>
    <br>
    <input type="radio" id="p10" name="p10" value="1 vez" <?php echo ($registro['p10'] == '1 vez') ? 'checked' : ''; ?>>
    <label for="p10">1 vez</label>
    <input type="radio" id="p10" name="p10" value="2 veces" <?php echo ($registro['p10'] == '2 veces') ? 'checked' : ''; ?>>
    <label for="p10">2 veces</label>
    <input type="radio" id="p10" name="p10" value="3 veces" <?php echo ($registro['p10'] == '3 veces') ? 'checked' : ''; ?>>
    <label for="p10">3 veces</label>
    </div>

    <div class="col-4">
    <label for="p11" class="form-label">¿Le sangran las encías? </label>
    <br>
    <input type="radio" id="p11" name="p11" value="Si" <?php echo ($registro['p11'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p11">Sí</label>
    <input type="radio" id="p11" name="p11" value="No" <?php echo ($registro['p11'] == 'No') ? 'checked' : ''; ?>>
    <label for="p11">No</label>
    </div>

    <div class="col-4">
    <label for="p12" class="form-label">Última visita al odontólogo (Año)</label>
    <input type="number" id="p12" name="p12" class="form-control" value="<?php echo $p12?>">
    </div>

    <div class="col-4">
    <label for="p14" class="form-label">¿Presion Arterial? </label>
    <br>
    <input type="radio" id="p14" name="p14" value="Alta" <?php echo ($registro['p14'] == 'Alta') ? 'checked' : ''; ?>>
    <label for="p14">Alta</label>
    <input type="radio" id="p14" name="p14" value="Normal" <?php echo ($registro['p14'] == 'Normal') ? 'checked' : ''; ?>>
    <label for="p14">Normal</label>
    <input type="radio" id="p14" name="p14" value="Baja" <?php echo ($registro['p14'] == 'Baja') ? 'checked' : ''; ?>>
    <label for="p14">Baja</label>
    </div>

    <div class="col-4">
    <label for="p15" class="form-label">¿Sufre de Herpes o aftas recurrentes? </label>
    <br>
    <input type="radio" id="p15" name="p15" value="Si" <?php echo ($registro['p15'] == 'Si') ? 'checked' : ''; ?>>
    <label for="p15">Sí</label>
    <input type="radio" id="p15" name="p15" value="No" <?php echo ($registro['p15'] == 'No') ? 'checked' : ''; ?>>
    <label for="p15">No</label>
    </div>

    <div class="col-4">
    <label for="p16" class="form-label">¿Antecedentes familiares de importancia? </label>
    <input type="text"  class="form-control" id="p16" name="p16" value="<?php echo $p16?>" >
    </div>

    <hr>


    <div class="col-12">
    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>







    </form>





<?php include("../../templates/footer.php");?>