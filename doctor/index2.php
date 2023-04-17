<?php 
include ("../db.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['correo'])) {
    $user_session = $_SESSION['correo'];
    
    // consulta para obtener el id del usuario
    $stmt = $conexion->prepare("SELECT idUser FROM users WHERE correo = ?");
    $stmt->execute([$user_session]);
    $row = $stmt->fetch();
    $idUser = $row['idUser'];
    
    // consulta para obtener el id del doctor
    $stmt = $conexion->prepare("SELECT idDoctor FROM doctor WHERE idUser = ?");
    $stmt->execute([$idUser]);
    $row = $stmt->fetch();
    $idDoctor = $row['idDoctor'];

    // consulta para obtener los tratamientos del doctor
    $stmt = $conexion->prepare("SELECT *,
        (SELECT dni FROM paciente WHERE paciente.idPaciente = tratamiento.idPaciente LIMIT 1) as paciente,
        (SELECT nombres FROM paciente WHERE paciente.idPaciente = tratamiento.idPaciente LIMIT 1) as nombrePaciente,
        (SELECT apePat FROM paciente WHERE paciente.idPaciente = tratamiento.idPaciente LIMIT 1) as apePat,
        (SELECT apaeMat FROM paciente WHERE paciente.idPaciente = tratamiento.idPaciente LIMIT 1) as apeMat,
        (SELECT nombres FROM doctor WHERE doctor.idDoctor = tratamiento.idDoctor LIMIT 1) as doctor,
        (SELECT nomSer FROM tiposervicio WHERE tiposervicio.idTipSer = tratamiento.idTipSer LIMIT 1) as servicio
        FROM tratamiento  
        WHERE idDoctor = ?");
    $stmt->execute([$idDoctor]);
    $lista_tratamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `tratamiento` WHERE idTrat=:idTrat");
    $sentencia->bindParam(":idTrat",$txtID);
    $sentencia->execute();
    header("Location:index2.php");
    

}






?>
<?php 


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
        include("../templates/header.php");   
    }else if($rol==2){
        include("../templates/Doctor/header.php");
    }
?>

    <br>
    <br>

    <h3>Tratamientos Odontológicos</h3>
    <br>

    <?php foreach($lista_tratamientos as $tratamiento)
                    
    { ?>
    <div class="card">
        <h5 class="card-header"><?php echo $tratamiento['nomTrata']; ?>: Tratamiento de <?php echo $tratamiento['servicio'];?></h5>
        <div class="card-body">
        <p class="card-title"><b>Paciente:</b> <?php echo $tratamiento['nombrePaciente'].' '.$tratamiento['apePat'].' '.$tratamiento['apeMat']; ?></p>
        <p class="card-title"><b>Fecha de Inicio:</b> <?php echo $tratamiento['fechIni']; ?> </p>
        <p class="card-title"><b>Médico Tratante:</b>  <?php echo $tratamiento['doctor']; ?> </p>
        <p class="card-title"><b>Detalle:</b> <?php echo $tratamiento['Comentarios']; ?> </p>
        

        <?php if ($tratamiento['estadoTratamiento']=="Activo"){ ?>
        <b><p class="text-success"> <?php echo $tratamiento['estadoTratamiento']; ?></p></b>
        <?php }
        else{ ?> 
        <b><p class="text-danger"> <?php echo $tratamiento['estadoTratamiento']; ?></p></b>
        <?php } ?> 

        <a name="" id="" class="btn btn-secondary" 
        href="../secciones/tratamiento/edit.php?txtID=<?php echo $tratamiento['idTrat']; ?>" role="button">Editar</a>
        |
        <a name="" id="" class="btn btn-primary" 
        href="../secciones/tratamiento/detalle.php?txtID=<?php echo $tratamiento['idTrat']; ?>" role="button">Detalle</a>
        |
        <a name="" id="" class="btn btn-info" 
        href="javascript:borrar3(<?php echo $tratamiento['idTrat']; ?>);" role="button">Eliminar</a>
        </div>


    </div>
    <br>

    <?php }?>

    <br><br><br>
    <div>
    <a name="" id="" class="btn btn-dark" 
    href="../secciones/tratamiento/create.php" role="button">Crear Tratamiento</a>
    <a name="" id="" class="btn btn-success" 
    href="../secciones/tratamiento/index.php" role="button">Regresar</a>
    </div>

    
        





<?php include("../templates/footer.php");?>