<?php 
include ("../db.php");

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

    $sentencia=$conexion->prepare("SELECT *,
    (SELECT nomTrata FROM tratamiento WHERE tratamiento.idTrat=examen.idTrat limit 1) as trat,
    (SELECT dni FROM paciente WHERE paciente.idPaciente=examen.idPaciente limit 1) as paciente
    FROM `examen`
    WHERE idTrat IN (SELECT idTrat FROM tratamiento WHERE idDoctor = ?)");
    $sentencia->execute([$idDoctor]);

    $lista_examenes=$sentencia->fetchAll(PDO::FETCH_ASSOC);
}



?>




<?php 

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `examen` WHERE idExamen=:idExamen");
    $sentencia->bindParam(":idExamen",$txtID);
    $sentencia->execute();
    header("Location:listaExamenes.php");

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

    <h3>Lista de Exámenes Médicos</h3>
<br>
<div class="card">

  <div class="card-body">

    <div class="table-responsive-sm">
      <table class="table table-striped table-hover" id="tabla">
        <thead>
          <tr align="center">
            <th scope="col">Paciente</th>
            <th scope="col">Examen</th>
            <th scope="col">Tratamiento</th>
            <th scope="col">Estado</th>
            <th scope="col">Documento</th>
            <th scope="col">Acciones</th>

          </tr>
        </thead>

        <tbody>
          <?php foreach ($lista_examenes as $examen) { ?>

            <tr class="">
              <td><?php echo $examen['paciente']; ?></td>
              <td><?php echo $examen['tipExamen']; ?></td>
              <td><?php echo $examen['trat']; ?></td>
              <td>
                <?php if (isset($examen['examen']) ? $examen['examen'] : "") { ?>
                  <b><p class="text-success">Enviado</p></b>
                <?php } else { ?>
                  <b><p class="text-danger">Pendiente</p></b>
                <?php } ?>
              </td>

              <?php if (isset($examen['examen']) ? $examen['examen'] : "") { ?>
                <td><a href="../secciones/examen/<?php echo $examen['examen'] ?>" download="examenDescarga" class="btn btn-primary">Descargar</a></td>
                <td>
              <?php } else { ?>
                <td><button class="btn btn-primary" type="button" disabled>Descargar</button></td>
                <td>
              <?php } ?>

              <a name="" id="" class="btn btn-secondary" href="../secciones/examen/edit.php?txtID=<?php echo $examen['idExamen']; ?>" role="button">Editar</a>
              |
              <a name="" id="" class="btn btn-danger" href="javascript:borrarExamen2(<?php echo $examen['idExamen']; ?>);" role="button">Eliminar</a>


              </td>
            </tr>

          <?php } ?>
        </tbody>

      </table>
      <a name="" id="" class="btn btn-dark" href="../secciones/examen/create.php" role="button">Crear Exámen</a>
      <a name="" id="" class="btn btn-warning" href="../secciones/tratamiento/index.php" role="button">Regresar</a>
    </div>
  </div>
</div>





<?php include("../templates/footer.php");?>