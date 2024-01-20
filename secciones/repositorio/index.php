
<?php 
include ("../../db.php");
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

<?php

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    // Buscar el archivo relacionado con el paciente
    $sentencia=$conexion->prepare("SELECT odontograma,moldeDental,intraoral,rostro FROM `repositorio`
    WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->execute();
    $encontrar_pdf=$sentencia->fetch(PDO::FETCH_LAZY);

    // Borrar el archivo 1
    if(isset($encontrar_pdf["odontograma"]) && $encontrar_pdf["odontograma"]!='' ){
        if(file_exists("../documentos/".$encontrar_pdf["odontograma"])){
            unlink("../documentos/".$encontrar_pdf["odontograma"] );         
        }
    }

    // Borrar el archivo 2
    if(isset($encontrar_pdf["moldeDental"]) && $encontrar_pdf["moldeDental"]!='' ){
        if(file_exists("../documentos/".$encontrar_pdf["moldeDental"])){
            unlink("../documentos/".$encontrar_pdf["moldeDental"] );         
        }
    }

    // Borrar el archivo 3
    if(isset($encontrar_pdf["intraoral"]) && $encontrar_pdf["intraoral"]!='' ){
        if(file_exists("../documentos/".$encontrar_pdf["intraoral"])){
            unlink("../documentos/".$encontrar_pdf["intraoral"] );         
        }
    }
    // Borrar el archivo 4
    if(isset($encontrar_pdf["rostro"]) && $encontrar_pdf["rostro"]!='' ){
        if(file_exists("../documentos/".$encontrar_pdf["rostro"])){
            unlink("../documentos/".$encontrar_pdf["rostro"] );         
        }
    }

    $sentencia=$conexion->prepare("DELETE FROM `repositorio` WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->execute();
    if($rol==1){ 
    header("Location:index.php");
    }else{
    header("Location:index2.php");
    }

}

// Instrucción de mostrado de Tabla

        $sentencia=$conexion->prepare("SELECT *,
        (SELECT correo FROM users 
        WHERE users.idUser=paciente.idUser limit 1) as usuario
        FROM `paciente`");
        $sentencia->execute();
        $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    


?>







    <br>
    <br>

    <h3>Repositorio de Imágenes</h3>

    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                <tfoot >
                <?php foreach($lista_pacientes as $paciente) 
                
                { ?>
                    <tr class="">
                        <td scope="row"><?php echo $paciente['dni']; ?></td>
                        <td><?php echo $paciente['nombres']." ".$paciente['apePat']." ".$paciente['apaeMat']; ?></td>
                        <td><?php echo $paciente['usuario']; ?></td>
                        <td>
                        <a name="" id="" class="btn btn-info"
                         href="imagenes.php?txtID=<?php echo $paciente['idPaciente']; ?>" role="button">
                         Ver Repositorio </a>
                            |
                         <a name="" id="" class="btn btn-primary" 
                        href="create.php?txtID=<?php echo $paciente['idPaciente']; ?>" role="button">Subir Documentos</a>
                            |

                            <a name="" id="" class="btn btn-danger" 
                        href="javascript:borrarRepo(<?php echo $paciente['idPaciente']; ?>);" role="button">Eliminar</a>
                        
                        
                        
                    </td>
                    </tr>
                   
                </tfoot>
                
                <?php } ?>
                
            </table>

            
        </div>
         


        </div>
        <?php 
        if($rol==1){ ?>
        <a name="" id="" class="btn btn-secondary" 
            href="../../index.php" role="button">Regresar al Menú</a>
        <?php }else if($rol==2){ ?>
            <a name="" id="" class="btn btn-secondary" 
            href="../../index2.php" role="button">Regresar al Menú</a>
        <?php }?>
        
    </div>

    




<?php include("../../templates/footer.php");?>