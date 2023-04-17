<?php 
include ("../../db.php");

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `doctor` WHERE idDoctor=:idDoctor");
    $sentencia->bindParam(":idDoctor",$txtID);
    $sentencia->execute();
    header("Location:index.php");

}

// Instrucción de mostrado de Tabla

$sentencia=$conexion->prepare("SELECT *,
(SELECT especialidad FROM especialidad 
WHERE especialidad.idEsp=doctor.idEsp limit 1) as especialidad,
(SELECT correo FROM users 
WHERE users.idUser=doctor.idUser limit 1) as usuario
FROM `doctor`");
$sentencia->execute();
$lista_doctores=$sentencia->fetchAll(PDO::FETCH_ASSOC);



?>



<?php include("../../templates/header.php");?>
    <br>
    <br>

    <h3>Lista de Doctores</h3>

    <br>
    <div class="card">
        
        <div class="card-body">
            
        
        <div class="table-responsive-sm" >
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr >
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Celular</th>           
                        <th scope="col">Usuario</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                <?php foreach($lista_doctores as $doctor) 
                
                { ?>
                <tfoot>
                    <tr class="">
                        <td scope="row"><?php echo $doctor['dni']; ?></td>
                        <td><?php echo $doctor['nombres']." ".$doctor['apePat']." ".$doctor['apaeMat']; ?></td>
                        <td><?php echo $doctor['especialidad']; ?></td>
                        <td><?php echo $doctor['celular']; ?></td>
                        <td><?php echo $doctor['usuario']; ?></td>
                        <td>
                        <a name="" id="" class="btn btn-secondary" 
                         href="edit.php?txtID=<?php echo $doctor['idDoctor']; ?>" 
                         role="button">Editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" 
                        href="javascript:borrar(<?php echo $doctor['idDoctor']; ?>);"
                         role="button">Eliminar</a>
                        
                        
                    </td>
                    </tr>
                </tfoot>
                <?php } ?>
            </table>
            <a name="" id="" class="btn btn-dark" 
            href="create.php" role="button">Agregar Doctor</a>
        </div>
        


        </div>

        
    </div>







<?php include("../../templates/footer.php");?>