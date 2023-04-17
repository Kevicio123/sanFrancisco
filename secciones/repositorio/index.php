
<?php 
include ("../../db.php");

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    // Buscar el archivo relacionado con el paciente
    $sentencia=$conexion->prepare("SELECT hisoriaClinic FROM `paciente`
    WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->execute();
    $encontrar_pdf=$sentencia->fetch(PDO::FETCH_LAZY);

    // Borrar el archivo
    if(isset($encontrar_pdf["hisoriaClinic"]) && $encontrar_pdf["hisoriaClinic"]!='' ){
        if(file_exists("./".$encontrar_pdf["hisoriaClinic"])){
            unlink("./".$encontrar_pdf["hisoriaClinic"] );         
        }
    }

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
                         Ver Imágenes </a>
                            |
                         <a name="" id="" class="btn btn-primary" 
                        href="create.php?txtID=<?php echo $paciente['idPaciente']; ?>" role="button">Subir Documentos</a>
                        
                        
                        
                    </td>
                    </tr>
                   
                </tfoot>
                
                <?php } ?>
                
            </table>

            
        </div>
         


        </div>

        
    </div>

    




<?php include("../../templates/footer.php");?>