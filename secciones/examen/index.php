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

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `examen` WHERE idExamen=:idExamen");
    $sentencia->bindParam(":idExamen",$txtID);
    $sentencia->execute();
    if($rol==1){
    header("Location:index.php");
    }else if($rol==2){
    header("Location:../../doctor/listaExamenes.php");
    }

}

// Instrucción de mostrado de Tabla

    $sentencia=$conexion->prepare("SELECT *,
    (SELECT nomTrata FROM tratamiento 
    WHERE tratamiento.idTrat=examen.idTrat limit 1) as trat,
    (SELECT dni FROM paciente 
    WHERE paciente.idPaciente=examen.idPaciente limit 1) as paciente
    FROM `examen`");
    $sentencia->execute();
    $lista_examenes=$sentencia->fetchAll(PDO::FETCH_ASSOC);



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
                
                <tfoot align="center">
                <?php foreach($lista_examenes as $examen)
                    
                { ?>
                    
                    <tr class="">
                        <td><?php echo $examen['paciente']; ?></td>
                        <td><?php echo $examen['tipExamen']; ?></td>
                        <td><?php echo $examen['trat']; ?></td>
                        <td><?php if (isset($examen['examen'])?$examen['examen']:""){ ?><b><p class="text-success">Enviado</p></b>
                        <?php
                        }else{ ?> 
                           <b><p class="text-danger">Pendiente</p></b>
                          </td> <?php } ?> 
                        
                        <?php if (isset($examen['examen'])?$examen['examen']:""){ ?> 
                        <td><a href="<?php echo $examen['examen']?>" download="examenDescarga" 
                        class="btn btn-primary">Descargar</a></td>
                        <td>
                        <?php
                        }else{ ?> 
                        <td><button 
                        class="btn btn-primary" type="button" disabled>Descargar</a></button>
                        <td>
                        <?php } ?> 




                        
                        <a name="" id="" class="btn btn-secondary" 
                         href="edit.php?txtID=<?php echo $examen['idExamen']; ?>" role="button">Editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" 
                         href="javascript:borrarExamen(<?php echo $examen['idExamen']; ?>);" role="button">Eliminar</a>
                        
                        
                    </td>
                    </tr>


                </tfoot>
                <?php }  ?>
                
            </table>
            <a name="" id="" class="btn btn-dark" 
            href="create.php" role="button">Crear Exámen</a>
            <a name="" id="" class="btn btn-warning" 
            href="../tratamiento/index.php" role="button">Regresar</a>
        </div>
        





<?php include("../../templates/footer.php");?>