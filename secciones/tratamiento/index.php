<?php
$url_base="http://localhost/proySanFranciscoPHP/";

?>
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

    <br>
    
    <h2 align="center">Sección de Tratamientos</h2>

    <br>

    <div class="row align-items-md-stretch">
        <div class="col-md-12">
            <div
                class="h-100 p-5 text-white bg-dark border rounded-3">
                <h2>Tratamientos Odontológicos</h2>
                <p>En esta sección usted podrá crear tratamientos odontológicos y asignarlo 
                    a un paciente en específico, esto a través del número de DNI del paciente a tratar.

                </p>
                <?php if($rol==1){?>
                <a class="btn btn-success" type="button" href="<?php echo $url_base;?>secciones/tratamiento/create.php">Crear Tratamiento</a>
                <a class="btn btn-secondary" type="button" href="<?php echo $url_base;?>secciones/tratamiento/index2.php">Lista de Tratamientos</a>
                <?php }else if($rol==2){?>

                <a class="btn btn-success" type="button" href="<?php echo $url_base;?>secciones/tratamiento/create.php">Crear Tratamiento</a>
                <a class="btn btn-secondary" type="button" href="../../doctor/index2.php">Lista de Tratamientos</a>

                <?php }?>
                
            </div>
            <br>
        </div>
        
        <div class="col-md-12">
        <br>
            <div
                class="h-100 p-5 bg-success border rounded-3">
                <h2>Examenes Médicos</h2>
                <p>En esta sección usted podrá crear exámenes médicos, asignárselo 
                    a un paciente en especifico y a su respectivo tratamiento en curso.</p>

                    <?php if($rol==1){?>
                    <a class="btn btn-dark" type="button" href="<?php echo $url_base;?>secciones/examen/create.php">Crear Examen</a>
                    <a class="btn btn-warning" type="button" href="<?php echo $url_base;?>secciones/examen/index.php">Lista de Exámenes</a>
                    <?php }else if($rol==2){?>
                    <a class="btn btn-dark" type="button" href="<?php echo $url_base;?>secciones/examen/create.php">Crear Examen</a>
                    <a class="btn btn-warning" type="button" href="../../doctor/listaExamenes.php">Lista de Exámenes</a>
                    <?php }?>
            </div>
        </div>
    </div>



<?php include("../../templates/footer.php");?>