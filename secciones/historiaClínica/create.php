<?php
include ("../../db.php");


if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT *,
     (SELECT nomTrata FROM tratamiento
     WHERE paciente.idPaciente=tratamiento.idPaciente) AS nomTrata,
     (SELECT Comentarios FROM tratamiento
     WHERE paciente.idPaciente=tratamiento.idPaciente) AS comentarios
     FROM `paciente` WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $dni=$registro["dni"];
    $nombres=$registro["nombres"];
    $apePat=$registro["apePat"];
    $apaeMat=$registro["apaeMat"];
    $sexo=$registro["sexo"];
    $fechaNac=$registro["fechaNac"];
    $direccion=$registro["direccion"];
    $distrito=$registro["distrito"];
    $celular=$registro["celular"];
    $hisoriaClinic=$registro["hisoriaClinic"];
    $idUser=$registro["idUser"];
    $edad=$registro["edad"];
    $nomTrata=$registro["nomTrata"];
    $comentarios=$registro["comentarios"];
    $fechaAten=$registro["fechaAten"];
    $asistencia=$registro["asistencia"];
  

    $sentencia2=$conexion->prepare("SELECT *
    FROM `atencion` a 
    INNER JOIN `paciente` p ON a.idPaciente =p.idPaciente
    WHERE p.idPaciente =$txtID");
    $sentencia2->execute();
    $lista_atenciones=$sentencia2->fetchAll(PDO::FETCH_ASSOC);



if($_POST){
    // Recolectamos los datos
    $idPaciente=(isset($_POST["txtID"])?$_POST["txtID"]:"");
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

    $sentencia=$conexion->prepare
    ("INSERT INTO historiaClinica(idHistoria,idPaciente,motivoConsulta,enfermedad,inicio,fin,
    p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14,p15,p16)
    VALUES(null,:idPaciente,:motivoConsulta,:enfermedad,:inicio,:fin,:p1,:p2,
    :p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10,:p11,:p12,:p13,:p14,:p15,:p16)");

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
    $mensaje="Historia clínica completada";
    header("Location:index.php?mensaje=".$mensaje);

}
}



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




?>

<?php
    if($rol==1){
        include("../../templates/header.php");   
    }else if($rol==2){
        include("../../templates/Doctor/header.php");
    }
?>


<form action="" method="post" class="row g-3" enctype="multipart/form-data">


    <h3>Historia Clínica del Paciente</h3>

    <div class="visually-hidden-focusable">
    <label for="idPaciente" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="idPaciente" name="idPaciente">
    </div>

    <div class="col-md-6">
    <label for="dni" class="form-label">DNI</label>
    <input type="char" value="<?php echo $dni;?>" class="form-control" id="dni" name="dni">
    </div>

    <div class="col-md-6">
    <label for="nombres" class="form-label">Nombres</label>
    <input type="text" value="<?php echo $nombres;?>" class="form-control" id="nombres" name="nombres">
    </div>

    <div class="col-md-6">
    <label for="apePat" class="form-label">Apellido Paterno</label>
    <input type="text" value="<?php echo $apaeMat;?>" class="form-control" id="apePat" name="apePat">
    </div>

    <div class="col-md-6">
    <label for="apaeMat" class="form-label">Apellido Materno</label>
    <input type="text" value="<?php echo $apePat;?>" class="form-control" id="apaeMat" name="apaeMat">
    </div>

    <div class="col-md-4">
    <label for="sexo" class="form-label">Sexo</label>
    <select id="sexo" name="sexo" class="form-select">
      <option <?php echo('sexo')?"selected":"";?>
      value="<?php echo $sexo; ?>">
      <?php echo $sexo; ?></option>
      <option value="Masculino">Masculino</option>
      <option value="Femenino">Femenino</option>
    </select>
    </div>


    </div>

    <div class="col-md-4">
    <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
    <input type="date" value="<?php echo $fechaNac;?>" class="form-control" id="fechaNac" name="fechaNac">
    </div>

    <div class="col-md-4">
    <label for="direccion" class="form-label">Direccion</label>
    <input type="text" value="<?php echo $direccion;?>" class="form-control" id="direccion" name="direccion">
    </div>


    <div class="col-md-4">
    <label for="distrito" class="form-label">Distrito</label>
    <select id="distrito" name="distrito" class="form-select">
      <option <?php echo('distrito')?"selected":"";?>
      value="<?php echo $distrito; ?>">
      <?php echo $distrito; ?></option>
      <option value="Cercado de Lima">Cercado de Lima</option>
      <option value="Miraflores">Miraflores</option>
      <option value="La Molina">La Molina</option>
      <option value="San Luis">San Luis</option>
      <option value="San Borja">San Borja</option>
      <option value="San Miguel">San Miguel</option>
      <option value="Santa Anita">Santa Anita</option>
      <option value="San Isidro">San Isidro</option>
      <option value="Pueblo Libre">Pueblo Libre</option>
      <option value="Puente Piedra">Puente Piedra</option>
      <option value="Ventanilla">Ventanilla</option>
    </select>
    </div>


    <div class="col-4">
    <label for="celular" class="form-label">Celular</label>
    <input type="char" value="<?php echo $celular;?>" class="form-control" id="celular" name="celular" placeholder="(+51)">
    </div>

    <div class="col-4">
    <label for="edad" class="form-label">Edad</label>
    <input type="number" id="edad" name="edad" value="<?php echo $edad;?>"class="form-control">
    </div>

    <hr>
    <div class="col-12">
    <label for="motivoConsulta" class="form-label">Motivo de Consulta</label>
    <input type="text"  class="form-control" id="motivoConsulta" name="motivoConsulta">
    </div>

    <div class="col-12">
    <label for="enfermedad" class="form-label">Enfermedad Actual</label>
    <input type="text"  class="form-control" id="enfermedad" name="enfermedad">
    </div>

    <label><b> Tiempo de Enfermedad </b></label>
    <div class="col-4">
    <label for="inicio" class="form-label">Inicio</label>
    <input type="date"  class="form-control" id="inicio" name="inicio">
    </div>

    <div class="col-4">
    <label for="fin" class="form-label">Fin/ Curso</label>
    <input type="date"  class="form-control" id="fin" name="fin">
    </div>

    <hr>

    <label><b> Signos y Síntomas principales </b></label>

    <div class="col-4">
    <label for="p1" class="form-label">¿Está bajo tratamiento médico?</label>
    <br><input type="radio" id="p1" name="p1" value="Si">
    <label for="p1">Sí</label>
    <input type="radio" id="p1" name="p1" value="No">
    <label for="p1">No</label>
    </div>

    <div class="col-4">
    <label for="p2" class="form-label">¿Toma actualmente medicamentos?</label>
    <br><input type="radio" id="p2" name="p2" value="Si">
    <label for="p2">Sí</label>
    <input type="radio" id="p2" name="p2" value="No">
    <label for="p2">No</label>
    </div>


    <div class="col-4">
    <label for="p3" class="form-label">¿Qué medicamentos toma?</label>
    <input type="text"  class="form-control" id="p3" name="p3">
    </div>

    <div class="col-4">
    <label for="p4" class="form-label">¿Le han realizado alguna intervención 
    quirúrgica?</label>
    <br>
    <input type="radio" id="p4" name="p4" value="Si">
    <label for="p4">Sí</label>
    <input type="radio" id="p4" name="p4" value="No">
    <label for="p4">No</label>
    </div>

    <div class="col-4">
    <label for="p5" class="form-label">¿Es alergico a algún medicamento?</label>
    <br>
    <input type="radio" id="p5" name="p5" value="Si">
    <label for="p5">Sí</label>
    <input type="radio" id="p5" name="p5" value="No">
    <label for="p5">No</label>
    </div>

    <div class="col-4">
    <label for="p13" class="form-label">¿A qué medicamentos es alergico?</label>
    <input type="text"  class="form-control" id="p13" name="p13">
    </div>

    <div class="col-4">
    <label for="p6" class="form-label">¿Ha recibido alguna transfusión sanguínea? </label>
    <br>
    <input type="radio" id="p6" name="p6" value="Si">
    <label for="p6">Sí</label>
    <input type="radio" id="p6" name="p6" value="No">
    <label for="p6">No</label>
    </div>

    <div class="col-4">
    <label for="p7" class="form-label">¿Está embarazada? </label>
    <br>
    <input type="radio" id="p7" name="p7" value="Si">
    <label for="p7">Sí</label>
    <input type="radio" id="p7" name="p7" value="No">
    <label for="p7">No</label>
    </div>

    <div class="col-4">
    <label for="p8" class="form-label">¿Está tomando actualmente 
    anticonceptivos? </label>
    <br>
    <input type="radio" id="p8" name="p8" value="Si">
    <label for="p8">Sí</label>
    <input type="radio" id="p8" name="p8" value="No">
    <label for="p8">No</label>
    </div>

    <div class="col-4">
    <label for="p9" class="form-label">¿Fuma? </label>
    <br>
    <input type="radio" id="p9" name="p9" value="Si">
    <label for="p9">Sí</label>
    <input type="radio" id="p9" name="p9" value="No">
    <label for="p9">No</label>
    </div>

    <div class="col-4">
    <label for="p10" class="form-label">¿Cuantas veces se lava los dientes? </label>
    <br>
    <input type="radio" id="p10" name="p10" value="1 vez">
    <label for="p10">1 vez</label>
    <input type="radio" id="p10" name="p10" value="2 veces">
    <label for="p10">2 veces</label>
    <input type="radio" id="p10" name="p10" value="3 veces">
    <label for="p10">3 veces</label>
    </div>

    <div class="col-4">
    <label for="p11" class="form-label">¿Le sangran las encías? </label>
    <br>
    <input type="radio" id="p11" name="p11" value="Si">
    <label for="p11">Sí</label>
    <input type="radio" id="p11" name="p11" value="No">
    <label for="p11">No</label>
    </div>

    <div class="col-4">
    <label for="p12" class="form-label">Última visita al odontólogo (Año)</label>
    <input type="number" id="p12" name="p12" class="form-control">
    </div>

    <div class="col-4">
    <label for="p14" class="form-label">¿Presion Arterial? </label>
    <br>
    <input type="radio" id="p14" name="p14" value="Alta">
    <label for="p14">Alta</label>
    <input type="radio" id="p14" name="p14" value="Normal">
    <label for="p14">Normal</label>
    <input type="radio" id="p14" name="p14" value="Baja">
    <label for="p14">Baja</label>
    </div>

    <div class="col-4">
    <label for="p15" class="form-label">¿Sufre de Herpes o aftas recurrentes? </label>
    <br>
    <input type="radio" id="p15" name="p15" value="Si">
    <label for="p15">Sí</label>
    <input type="radio" id="p15" name="p15" value="No">
    <label for="p15">No</label>
    </div>

    <div class="col-4">
    <label for="p16" class="form-label">¿Antecedentes familiares de importancia? </label>
    <input type="text"  class="form-control" id="p16" name="p16">
    </div>

    <hr>

    <label><b> Tratamiento en Curso</b></label>

    <div class="col-12">
    <label for="tratamiento" class="form-label">DX</label>
    <input type="text" id="tratamiento" name="tratamiento" value="<?php echo $nomTrata;?>" class="form-control">
    </div>

    <div class="col-12">
    <label for="tratamiento" class="form-label">Plan del Tratamiento</label><br>
    <input type="text" id="tratamiento" name="tratamiento" value="<?php echo $comentarios;?>" class="form-control">

    </div>

    <hr>
    <label><b> Atenciones Médicas </b></label>

    <?php foreach ($lista_atenciones as $atencion) { ?>

    <div class="col-4">
    <label for="fechCita" class="form-label">Fecha</label>
    <input type="date" id="fechCita" name="fechCita" value="<?php echo $atencion['fechAten'];?>" class="form-control">
    </div>

    <div class="col-8">
    <label for="atención" class="form-label">Atención</label>
    <input type="text" id="atención" name="atención" value="<?php echo $atencion['Comentarios'];?>"class="form-control">
    </div>

    <?php }
    ?>
    







    <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>







    </form>





<?php include("../../templates/footer.php");?>