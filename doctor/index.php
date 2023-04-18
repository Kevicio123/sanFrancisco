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
 if($rol==1){
    include("../templates/header.php");   
 }else if($rol==2){
    include("../templates/Doctor/header.php");
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
    (SELECT nombres FROM doctor 
    WHERE doctor.idDoctor=atencion.idDoctor limit 1) as doctor,
    (SELECT dni FROM paciente
    WHERE paciente.idPaciente=atencion.idPaciente limit 1) as paciente
    FROM `atencion`
    WHERE idDoctor = ?");
    $sentencia->execute([$idDoctor]);
    $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);
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
                        <th scope="col">Hora</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Comentarios</th>
                        <th scope="col">Link de Reunión</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                
                <tfoot align="center">
                <?php foreach($lista_pacientes as $paciente) 
                
                {?>

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


                    <tr class="">
                        <td><?php echo $paciente['paciente']; ?></td>
                        <td scope="row"><?php echo $fecha_formateada; ?></td>
                        <td><?php echo $hora_am_pm; ?></td>
                        <td><?php echo $paciente['doctor']; ?></td>
                        <td><?php echo $paciente['estado']; ?></td>
                        <td><?php echo $paciente['Comentarios']; ?></td>
                        <td><?php echo $paciente['linkAten']; ?></td>
                        <td>
                        <a name="" id="" class="btn btn-secondary" 
                        href="../secciones/atenciones/edit.php?txtID=<?php echo $paciente['idAtencion']; ?>"
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
            href="../secciones/atenciones/create.php" role="button">Enviar Reunión Médica</a>
        </div>
        





<?php include("../templates/footer.php");?>