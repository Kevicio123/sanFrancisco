<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Reporte de Pacientes</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php 
include ("../../db.php");

// Instrucción de recepcion de ID e informacion


    $sentencia=$conexion->prepare("SELECT *,
    (SELECT correo FROM users 
    WHERE users.idUser=paciente.idUser limit 1) as usuario
    FROM `paciente`");
    $sentencia->execute();
    $paciente=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    $fecha= date("Y-m-d");



?>

<div>
    Lima, Perú <strong> <?php echo $fecha?></strong>
    <br><h2>Reporte de Pacientes</h2>
            <table class="table table-striped table-hover" id="">
                <thead>
                    <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Usuario</th>
                        
                    </tr>
                </thead>
                <tfoot >
                    <?php foreach($paciente as $paciente){?>
               
                    <tr class="">
                    <td><?php echo $paciente['dni']?></td>
                    <td><?php echo $paciente['nombres'].' '.$paciente['apePat'].' '.$paciente['apaeMat']?></td>
                    <td><?php echo $paciente['sexo']?></td>
                    <td><?php echo $paciente['direccion'].' '.$paciente['distrito']?></td>
                    <td><?php echo $paciente['celular']?></td>
                    <td><?php echo $paciente['usuario']?></td>
                    </tr>
                   
                </tfoot>
                    <?php
                    }
                    ?>
                
            </table>
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
$dompdf->setPaper('A4','landscape');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));



?>