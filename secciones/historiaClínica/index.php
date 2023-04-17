<?php 
include ("../../db.php");

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";


    $sentencia=$conexion->prepare("DELETE FROM `historiaclinica` WHERE idPaciente=:idPaciente");
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

    <h3>Historias Clínicas</h3>

    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table table-striped table-hover" id="tabla">
                <thead align="center">
                    <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col" align="center">Acciones</th>
                        <td></td>
                        
                        
                    </tr>
                </thead>
                <tfoot >

                <?php foreach($lista_pacientes as $paciente) {
                $sentencia2 = $conexion->prepare("SELECT * FROM `historiaclinica` WHERE idPaciente = ?");
                $sentencia2->execute(array($paciente['idPaciente']));
                $historiaclinica = $sentencia2->fetchAll(PDO::FETCH_ASSOC);

                if (count($historiaclinica) > 0) {
                ?>
                <tr class="">
                        <td scope="row"><?php echo $paciente['dni']; ?></td>
                        <td><?php echo $paciente['nombres']." ".$paciente['apePat']." ".$paciente['apaeMat']; ?></td>
                        <td><?php echo $paciente['usuario']; ?></td>
                        <td colspan="4">
                        <a name="" id="" class="btn btn-success btn-xs" 
                        href="editar.php?txtID=<?php echo $paciente['idPaciente']; ?>"
                        role="button">Actualizar Historia</a>
                       
                        |
                        <a name="" id="" class="btn btn-secondary" target="_blank"
                         href="historia.php?txtID=<?php echo $paciente['idPaciente']; ?>;"
                         role="button">Ver Historia Clínica</a>
                        |
                        <a name="" id="" class="btn btn-danger" 
                         href="javascript:borrarHistoria(<?php echo $paciente['idPaciente']; ?>);"
                         role="button">Eliminar</a>
                    </td>

                        
                    </tr>
                   
                </tfoot>

                <?php
                 } else {
                ?>

                <tr class="">
                        <td scope="row"><?php echo $paciente['dni']; ?></td>
                        <td><?php echo $paciente['nombres']." ".$paciente['apePat']." ".$paciente['apaeMat']; ?></td>
                        <td><?php echo $paciente['usuario']; ?></td>
                        <td colspan="4">
                        <a name="" id="" class="btn btn-success disabled"
                        href="editar.php?txtID=<?php echo $paciente['idPaciente']; ?>"
                        role="button">Actualizar Historia</a>
                        |
                        <a name="" id="" class="btn btn-secondary" 
                        href="create.php?txtID=<?php echo $paciente['idPaciente']; ?>"
                        role="button">Completar Historia</a>
                        |
                        <a name="" id="" class="btn btn-danger disabled" 
                        href="editar.php?txtID=<?php echo $paciente['idPaciente']; ?>"
                        role="button">Eliminar</a>
                    </td>

                        
                    </td>

                    

                        
                    </tr>
                   
                </tfoot>


                <?php
                }
                ?>
                    
                
                <?php } ?>
                
            </table>

            <a name="" id="" class="btn btn-secondary" 
            href="../../index2.php" role="button">Menú Principal</a>
        </div>
         


        </div>

        
    </div>




    
<?php
  
    include("../../templates/footer.php");   
    
?>
