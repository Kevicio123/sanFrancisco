<?php 
include ("../../db.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT *
    FROM repositorio 
    WHERE idPaciente ='$txtID'");
    $sentencia->execute();
    $imagenes=$sentencia->fetchAll(PDO::FETCH_ASSOC);


    $sentencia2=$conexion->prepare("SELECT *
    FROM `paciente` p 
    INNER JOIN `examen` e ON p.idPaciente =e.idPaciente
    WHERE p.idPaciente =$txtID");
    $sentencia2->execute();
    $examenes=$sentencia2->fetchAll(PDO::FETCH_ASSOC);

    $sentencia3=$conexion->prepare("SELECT *
     FROM paciente 
    WHERE idPaciente = '$txtID'");
    $sentencia3->execute();
    $pacientes=$sentencia3->fetchAll(PDO::FETCH_ASSOC);


    foreach($pacientes as $paciente){
        $nombrePaciente=$paciente['nombres'].' '.$paciente['apePat'].' '.$paciente['apaeMat'];
        
    }

    $link="http://localhost/proySanFranciscoPHP/secciones/historiaCl%C3%ADnica/historia.php?txtID=$txtID;";


    

}

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
<br><br>

<div class="container">

<h3 align="center">Repositorio de Imágenes</h3>

<br>
<p><b> Paciente: </b><?php echo $nombrePaciente?></p>


<a name="" id="" class="btn btn-info"
href="index.php" role="button">
Regresar</a>


<br><br>

<h4>Odontogramas</h4>

<div class="row">

<?php 
if(count($imagenes) > 0) {
    foreach($imagenes as $imagen){ 
        if (isset($imagen['odontograma'])?$imagen['odontograma']:""){  
?>
            <div class="col-md-4">
                <div class="card" style="width: 16rem;">
                    <a href="../documentos/<?php echo $imagen['odontograma'];?>" target="_blank">
                    <img class="card-img-top" src="../documentos/<?php echo $imagen['odontograma'];?>">
                    </a>
                </div>
            </div>

<?php 
        }
    } 
} else {
    echo '<li>No hay datos disponibles.</li>';
}
?>

</div>


<br>
<hr style="width:100%;">
<h4>Moldes Dentales</h4>

<div class="row">
<?php 
if(count($imagenes) > 0) {
    foreach($imagenes as $imagen){ 
        if (isset($imagen['moldeDental'])?$imagen['moldeDental']:""){  
?>
            <div class="col-md-4">
                <div class="card" style="width: 16rem;">
                    <a href="../documentos/<?php echo $imagen['moldeDental'];?>" target="_blank">
                    <img class="card-img-top" src="../documentos/<?php echo $imagen['moldeDental'];?>">
                    </a>
                </div>
            </div>

<?php 
        }
    } 
} else {
    echo '<li>No hay datos disponibles.</li>';
}
?>

</div>


<br>
<hr style="width:100%;">
<h4>Historia Clínica</h4>

<li><a href="<?php echo $link?>" target="_blank">Link de la Historia Clínica</a></li>
<br>
<hr style="width:100%;">
<h4>Exámenes Médicos</h4>

<div class="row">
<?php 
if(count($examenes) > 0) {
    foreach($examenes as $examen){ 
        if (isset($examen['examen'])?$examen['examen']:""){  
?>
            <div class="col-md-4">
                <div class="card" style="width: 16rem;">
                    <a href="../examen/<?php echo $examen['examen'];?>" target="_blank">
                    <img class="card-img-top" src="../examen/<?php echo $examen['examen'];?>">
                    </a>
                </div>
            </div>

<?php 
        }
    } 
} else {
    echo '<li>No hay datos disponibles.</li>';
}
?>

</div>


<br>
<hr style="width:100%;">
<h4>Imágenes Intraorales</h4>

<div class="row">

<?php 
if(count($imagenes) > 0) {
    foreach($imagenes as $imagen){ 
        if (isset($imagen['intraoral'])?$imagen['intraoral']:""){  
?>
            <div class="col-md-4">
                <div class="card" style="width: 16rem;">
                    <a href="../documentos/<?php echo $imagen['intraoral'];?>" target="_blank">
                    <img class="card-img-top" src="../documentos/<?php echo $imagen['intraoral'];?>">
                    </a>
                </div>
            </div>

<?php 
        }
    } 
} else {
    echo '<li>No hay datos disponibles.</li>';
}
?>

</div>

<br>
<hr style="width:100%;">
<h4>Rostro del Paciente</h4>

<div class="row">

<?php 
if(count($imagenes) > 0) {
    foreach($imagenes as $imagen){ 
        if (isset($imagen['rostro'])?$imagen['rostro']:""){  
?>
            <div class="col-md-4">
                <div class="card" style="width: 16rem;">
                    <a href="../documentos/<?php echo $imagen['rostro'];?>" target="_blank">
                    <img class="card-img-top" src="../documentos/<?php echo $imagen['rostro'];?>">
                    </a>
                </div>
            </div>

<?php 
        }
    } 
} else {
    echo '<li>No hay datos disponibles.</li>';
}
?>

</div>






</div>



<?php include("../../templates/Doctor/footer.php"); ?>