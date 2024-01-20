
<?php 
include ("../../db.php");

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `paciente` WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->execute();
    header("Location:index.php");

}

// Instrucción de mostrado de Tabla

    $sentencia=$conexion->prepare("SELECT *,
    (SELECT correo FROM users 
    WHERE users.idUser=paciente.idUser limit 1) as usuario
    FROM `paciente`");
    $sentencia->execute();
    $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);



?>

<?php 

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
$n=1;
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

    <h3>Lista de Pacientes</h3>

    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">Registro</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Distrito</th>
                        <th scope="col">Celular</th>
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
                        <td><?php echo $paciente['sexo'];?></td>
                        <td><?php echo $paciente['distrito'];?></td>
                        <td><?php echo $paciente['celular'];?></td>
                        <td><?php echo $paciente['usuario'];?></td>
                        <td colspan="3">
                        <a name="" id="" class="btn btn-dark" target="_blank"
                         href="carta_datos.php?txtID=<?php echo $paciente['idPaciente'];?>" role="button">Detalle</a>
                        |
                        <a name="" id="" class="btn btn-primary" 
                        href="edit.php?txtID=<?php echo $paciente['idPaciente'];?>"
                        role="button">Editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" 
                         href="javascript:borrar(<?php echo $paciente['idPaciente'];?>);"
                         role="button">Eliminar</a>
                        
                        
                    </td>
                    </tr>
                   
                    <?php } ?>
                </tbody>
            </table>

            <a name="" id="" class="btn btn-primary" 
            href="create.php" role="button">Agregar Paciente</a>
        </div>
        </div>
        
    </div>

    <a name="" id="" class="btn btn-secondary" 
            href="../../index.php" role="button">Regresar al Menú</a>

    




<?php include("../../templates/footer.php");?>