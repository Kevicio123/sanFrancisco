<?php 
include ("../../db.php");

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT *,
    (SELECT correo FROM users 
    WHERE users.idUser=paciente.idUser limit 1) as usuario
     FROM `paciente` WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    

    $dni=$registro["dni"];
    $nombres=$registro["nombres"];
    $apePat=$registro["apePat"];
    $apaeMat=$registro["apaeMat"];
    $sexo=$registro["sexo"];
    $fechaNac=$registro["fechaNac"];
    $direccion=$registro["direccion"];
    $distrito=$registro["distrito"];
    $celular=$registro["celular"];
    $idUser=$registro["idUser"];
    $usuario=$registro["usuario"];
    


    $nombreCompleto=$nombres." ".$apePat." ".$apaeMat;

    $fecha= date("Y-m-d");

    $vivienda=$direccion.", ".$distrito;

    
    

}
ob_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Paciente</title>
</head>
<body>
    <br>
    <h2>Datos del Paciente</h2>
    <br>
    Lima, Perú <strong> <?php echo $fecha?></strong>
    <br><br>
    Información de Paciente <strong><?php echo $nombreCompleto?></strong>
    <br>
    <br>
    <strong>DNI: </strong> <?php echo $dni?><br>
    <strong>Sexo: </strong> <?php echo $sexo?><br>
    <strong>Correo: </strong> <?php echo $usuario?><br>
    <strong>Fecha de Nacimiento: </strong> <?php echo $fechaNac?><br>
    <strong>Vivienda: </strong> <?php echo $vivienda?><br>
    <br>

</body>
</html>

<?php
$html=ob_get_clean();

require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf=new Dompdf();
$opciones=$dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));
$dompdf->setOptions($opciones);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));



?>