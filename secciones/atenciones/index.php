<?php 
include ("../../db.php");

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `atencion` 
    WHERE idAtencion=:idAtencion");
    $sentencia->bindParam(":idAtencion",$txtID);
    $sentencia->execute();
    header("Location:index.php");


}

// Instrucción de mostrado de Tabla

$sentencia=$conexion->prepare("SELECT *,
(SELECT nombres FROM doctor 
WHERE doctor.idDoctor=atencion.idDoctor limit 1) as doctor,
(SELECT dni FROM paciente
WHERE paciente.idPaciente=atencion.idPaciente limit 1) as paciente
FROM `atencion`");
$sentencia->execute();
$lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);




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
    <br>
    <br>

    <h3>Lista de Atenciones Médicas</h3>
    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr align="center">
                        <th scope="col">Paciente</th>
                        <th scope="col">Fecha de Atención</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Comentarios</th>
                        <th scope="col">Link de Reunión</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                
                <tfoot align="center">
                <?php foreach($lista_pacientes as $paciente) 
                
                {?>

                


                    <tr class="">
                        <td><?php echo $paciente['paciente']; ?></td>
                        <td scope="row"><?php echo $paciente['fechAten']; ?></td>
                        <td><?php echo $paciente['estado']; ?></td>
                        <td><?php echo $paciente['doctor']; ?></td>
                        <td><?php echo $paciente['Comentarios']; ?></td>
                        <td><?php echo $paciente['linkAten']; ?></td>
                        <td>
                        <a name="" id="" class="btn btn-secondary" 
                        href="edit.php?txtID=<?php echo $paciente['idAtencion']; ?>"
                        role="button">Editar</a>
                        
                        |
                        <a name="" id="" class="btn btn-danger" 
                         href="javascript:borrar(<?php echo $paciente['idAtencion']; ?>);"
                         role="button">Eliminar</a>
                        
                        
                    </td>
                    </tr>
                 
                </tfoot>
                <?php } ?>   
                
            </table>
            <a name="" id="" class="btn btn-dark" 
            href="create.php" role="button">Enviar Reunión Médica</a>
        </div>
        





<?php include("../../templates/footer.php");?>