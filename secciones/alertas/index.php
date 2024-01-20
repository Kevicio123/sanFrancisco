<?php 
session_start();
include ("../../db.php");
$user_session=$_SESSION['correo'];
$paciente = $conexion->prepare
("SELECT * FROM users 
WHERE correo = '$user_session'");
$paciente->execute();
$pacientes=$paciente->fetchAll(PDO::FETCH_ASSOC);


foreach($pacientes as $paciente ){
    $rol=$paciente['idRoles'];
}
$n=1;
// Instrucción de mostrado de Tabla

    $sentencia=$conexion->prepare("SELECT *,
    (SELECT correo FROM users 
    WHERE users.idUser=paciente.idUser limit 1) as usuario
    FROM `paciente`");
    $sentencia->execute();
    $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
    if($rol==1){
        include("../../templates/header.php");   
    }else if($rol==2){
        include("../../templates/Doctor/header.php");
    }
?>

<br><br>

<h3 align="center">Envío de Alertas Médicas</h3>

    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table table-striped" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">Registro</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_pacientes as $paciente) 
                
                { ?>
                    <tr class="">
                        <td align="center"><?php echo $n++;?></td>
                        <td scope="row"><?php echo $paciente['dni'];?></td>
                        <td><?php echo $paciente['nombres']." ".$paciente['apePat']." ".$paciente['apaeMat'];?></td>
                        <td><?php echo $paciente['usuario'];?></td>
                        <td>
                        <a name="" id="" class="btn btn-danger" 
                        href="alerta.php?txtID=<?php echo $paciente['idPaciente'];?>"
                        role="button">Enviar Alerta Médica</a>

                        
                    </td>
                    </tr>
                   
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
        
    </div>

    <?php if($rol==1) { ?>

    <a name="" id="" class="btn btn-secondary" 
            href="../../index.php" role="button">Regresar al Menú</a>
    <?php } else if($rol==2) { ?>
    <a name="" id="" class="btn btn-secondary" 
            href="../../index2.php" role="button">Regresar al Menú</a>
    <?php } ?>

<?php include("../../templates/footer.php");?>
