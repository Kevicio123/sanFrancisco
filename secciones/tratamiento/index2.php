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

    $sentencia=$conexion->prepare("DELETE FROM `tratamiento` WHERE idTrat=:idTrat");
    $sentencia->bindParam(":idTrat",$txtID);
    $sentencia->execute();
    header("Location:index2.php");

}

// Instrucción de mostrado de Tabla

    $sentencia=$conexion->prepare("SELECT *,
    (SELECT dni FROM paciente 
    WHERE paciente.idPaciente=tratamiento.idPaciente limit 1) as paciente,
    (SELECT nombres FROM doctor 
    WHERE doctor.idDoctor=tratamiento.idDoctor limit 1) as doctor,
    (SELECT nomSer FROM tiposervicio 
    WHERE tiposervicio.idTipSer=tratamiento.idTipSer limit 1) as servicio
    FROM `tratamiento`");
    $sentencia->execute();
    $lista_tratamientos=$sentencia->fetchAll(PDO::FETCH_ASSOC);



?>


    <br>
    <br>

    <h3>Lista de Tratamientos Odontológicos</h3>
    <br>

    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr align="center">
                        <th scope="col">Paciente</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Tratamiento</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Estado</th>    
                        <th scope="col">Fecha Inicio</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                <tbody >
                <?php foreach($lista_tratamientos as $tratamiento)
                    
                    { ?>
                    
                    <tr class="">
                        <td><?php echo $tratamiento['paciente']; ?></td>
                        <td><?php echo $tratamiento['doctor']; ?></td>
                        <td><?php echo $tratamiento['nomTrata']; ?></td>
                        <td><?php echo $tratamiento['servicio']; ?></td>
                        <td>
                        <?php if ($tratamiento['estadoTratamiento']=="Activo"){ ?>
                            <b><p class="text-success"> <?php echo $tratamiento['estadoTratamiento']; ?></p></b>
                            <?php }
                            else{ ?> 
                            <b><p class="text-danger"> <?php echo $tratamiento['estadoTratamiento']; ?></p></b>
                            </td> <?php } ?> 

                        </td>

                        <td><?php echo $tratamiento['fechIni']; ?></td>
                        
                        <td colspan="3">
                    
                        <a name="" id="" class="btn btn-secondary" 
                         href="edit.php?txtID=<?php echo $tratamiento['idTrat']; ?>" role="button">Editar</a>
                        |
                        <a name="" id="" class="btn btn-primary" 
                         href="detalle.php?txtID=<?php echo $tratamiento['idTrat']; ?>" role="button">Detalle</a>
                         |
                        <a name="" id="" class="btn btn-danger" 
                         href="javascript:borrar3(<?php echo $tratamiento['idTrat']; ?>);" role="button">Eliminar</a>
                        
                         
                    </td>
                    </tr>
                    <?php }  ?>
                </tbody>
            </table>
            <a name="" id="" class="btn btn-dark" 
            href="create.php" role="button">Crear Tratamiento</a>
            <a name="" id="" class="btn btn-warning" 
            href="index.php" role="button">Regresar</a>
        </div>
        





<?php include("../../templates/footer.php");?>