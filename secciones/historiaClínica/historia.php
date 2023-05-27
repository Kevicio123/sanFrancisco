<?php

ob_start();
include ("../../db.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT *,
     (SELECT nomTrata FROM tratamiento
     WHERE paciente.idPaciente=tratamiento.idPaciente) AS nomTrata,
     (SELECT Comentarios FROM tratamiento
     WHERE paciente.idPaciente=tratamiento.idPaciente) AS comentarios,
     (SELECT dx FROM tratamiento
     WHERE paciente.idPaciente=tratamiento.idPaciente) AS dx
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
    $lugarNac=$registro["lugarNac"];
    $telefono=$registro["telefono"];
    $idUser=$registro["idUser"];
    $edad=$registro["edad"];
    $nomTrata=$registro["nomTrata"];
    $dx=$registro["dx"];
    $comentarios=$registro["comentarios"];
    $fechaAten=$registro["fechaAten"];
    $asistencia=$registro["asistencia"];
  
    
    $nombreCompleto=$nombres." ".$apePat." ".$apaeMat;

    $fecha= date("Y-m-d");

    $sentencia2=$conexion->prepare("SELECT *
    FROM `eventoscalendar` e 
    INNER JOIN `paciente` p ON e.idPaciente =p.idPaciente
    WHERE p.idPaciente =$txtID");
    $sentencia2->execute();
    $lista_atenciones=$sentencia2->fetchAll(PDO::FETCH_ASSOC);

    $sentencia3=$conexion->prepare("SELECT *
    FROM `historiaclinica` h 
    INNER JOIN `paciente` p ON h.idPaciente =p.idPaciente
    WHERE p.idPaciente =$txtID");
    $sentencia3->execute();
    $historiaCli=$sentencia3->fetchAll(PDO::FETCH_ASSOC);

   

    foreach($historiaCli as $historia){
        $motivoConsulta=$historia['motivoConsulta'];
        $enfermedad=$historia['enfermedad'];
        $inicio=$historia['inicio']; 
        $fin=$historia['fin'];
        $p1=$historia['p1'];
        $p2=$historia['p2'];
        $p3=$historia['p3'];
        $p4=$historia['p4'];
        $p5=$historia['p5'];
        $p6=$historia['p6'];
        $p7=$historia['p7'];
        $p8=$historia['p8'];
        $p9=$historia['p9'];
        $p10=$historia['p10'];
        $p11=$historia['p11'];
        $p12=$historia['p12'];
        $p13=$historia['p13'];
        $p14=$historia['p14'];
        $p15=$historia['p15'];
        $p16=$historia['p16'];
    }

    

    
    $fechInicioTrabajo = $inicio; // fecha de inicio de trabajo
    $fechFinTrabajo = $fin; // fecha de fin de trabajo (hoy)

    // Convertimos las fechas en objetos de fecha
    $fechaInicio = new DateTime($fechInicioTrabajo);
    $fechaFin = new DateTime($fechFinTrabajo);

    // Calculamos la diferencia entre las fechas
    $diferencia = $fechaInicio->diff($fechaFin);

    // Mostramos la diferencia en formato de años, meses y días
    $mensaje=$diferencia->y . " años, " . $diferencia->m . " meses y " . $diferencia->d . " días.";

    
}

?>

<style>
    table.table2{
        border: 1px solid black;
        border-collapse: collapse;
    }
    tr.table2{
        border: 1px solid black;
    }
    td.table2{
        border: 1px solid black;
    }

</style>

<link rel="stylesheet" href="css/style.css">


<img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/proySanFranciscoPHP/images/cabezalHistoria.jpg" alt="1000" width="725" sizes="" srcset="">
<br>

<label for="fecha"><b> Fecha: </b> <?php echo $fecha ?></label><br>

<table class="table borderless">

<tr>
    <td>
    <label for="dni" class="form-label"><b> Nombres y Apellidos:</b> <?php echo isset($nombreCompleto)?$nombreCompleto:"" ?></label>
    </td>

    
    <td>
    <label for="edad" class="form-label"><b> Edad:</b> <?php echo isset($edad)?$edad:""?></label>
    </td>

    <td> 
    <label for="sexo" class="form-label"><b> Sexo:</b> <?php echo isset($sexo)?$sexo:""?></label>
    </td>
</tr>


<tr>
    <td>
    <label for="dni" class="form-label"><b>Fecha de Nacimiento:</b> <?php echo isset($fechaNac)?$fechaNac:"" ?></label>
    </td>

    
    <td>
    <label for="edad" class="form-label"><b> Lugar de nacimiento:</b> <?php echo  isset($lugarNac)?$lugarNac:""?></label>
    </td>
</tr>



<tr>
    <td>
    <label for="dni" class="form-label"><b>Dirección:</b> <?php echo $direccion ?></label>
    </td>

    <td>
    <label for="edad" class="form-label"><b> Distrito:</b> <?php echo $distrito?></label>
    </td>
</tr>


<tr>
    <td>
    <label for="dni" class="form-label"><b>Telefono:</b> <?php echo $telefono ?></label>
    </td>

    
    <td>
    <label for="edad" class="form-label"><b>Celular:</b> <?php echo $celular?></label>
    </td>
</tr>


<tr>
    <td></td>
</tr>
</table>


<table>
<tr>
    <td>
    <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/proySanFranciscoPHP/images/imgH.jpg" alt="5" width="725" sizes="" srcset="">
    </td>
</tr>
</table>



<table>

<tr>
    <td>
    <label for="motivoConsulta" class="form-label"><b>Motivo de Consulta:</b> <?php echo  isset($motivoConsulta)?$motivoConsulta:"" ?></label>
    </td>
</tr>


<tr>
    <td>
    <label for="enfermedad" class="form-label"><b>Enfermedad:</b> <?php echo isset($enfermedad)?$enfermedad:""?></label>
    </td>
</tr>

<tr>
    <td>
    <label for="fin" class="form-label"><b>Curso:</b> <?php echo isset($fin)?$fin:""  ?></label>
    </td>
    <td colspan="2">
    <label for="inicio" class="form-label"><b>Inicio:</b> <?php echo isset($inicio)?$inicio:"" ?></label>
    </td>
</tr>

<tr>
    <td>
    <label for="tiempo" class="form-label"><b>Tiempo de Enfermedad:</b> <?php echo isset($mensaje)?$mensaje:""  ?></label>
    </td>   
</tr>

</table><br>

<table class="table2" align="center">

<tr class="table2">
    <td class="table2">
    <label for="" class="form-label"><b></b></label><br><br>
    </td>

    <td class="table2">
    <label for="enfermedad" class="form-label"><b>SI</b></label><br><br>
    </td>

    <td class="table2">
    <label for="enfermedad" class="form-label"><b>NO</b></label><br><br>
    </td>

    <td class="table2">
    <label for="enfermedad" class="form-label"><b></b></label><br><br>
    </td>

    <td class="table2">
    <label for="enfermedad" class="form-label"><b>SI</b></label><br><br>
    </td>

    <td class="table2">
    <label for="enfermedad" class="form-label"><b>NO</b></label><br><br>
    </td>

</tr>




<tr class="table2">
<td class="table2">
    <label for="p1" class="form-label">¿Estas bajo tratamiento médico?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p1" class="form-label"><?php echo isset($p1)?$p1:""  ?></label><br><br>
    </td>

    <td class="table2">
    <label for="p8" class="form-label">¿Está tomando actualmente anticoceptivos?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p8" class="form-label"><?php echo isset($p8)?$p8:""?>&nbsp;&nbsp;</label><br><br>
    </td> 
</tr>

<tr class="table2">
<td class="table2">
    <label for="p1" class="form-label">¿Toma actualmente medicamentos?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p1" class="form-label"><?php echo isset($p2)?$p2:"" ?></label><br><br>
    </td>

    <td class="table2">
    <label for="p8" class="form-label">¿Qué medicamentos toma?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p8" class="form-label"><?php echo isset($p3)?$p3:"" ?>&nbsp;&nbsp;</label><br><br>
    </td>
</tr>

<tr class="table2">
<td class="table2">
    <label for="p1" class="form-label">¿Le han realizado alguna intervención 
    quirúrgica?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p4" class="form-label"><?php echo isset($p4)?$p4:""  ?></label><br><br>
    </td>

    <td class="table2">
    <label for="p8" class="form-label">¿Es alergico a algún medicamento?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p8" class="form-label"><?php echo isset($p5)?$p5:"" ?>&nbsp;&nbsp;</label><br><br>
    </td>
</tr>

<tr class="table2">
<td class="table2">
    <label for="p1" class="form-label">¿A qué medicamentos es alergico?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p13" class="form-label"><?php echo isset($p13)?$p13:""?></label><br><br>
    </td>

    <td class="table2">
    <label for="p8" class="form-label">¿Ha recibido alguna transfusión sanguínea? </label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p6" class="form-label"><?php echo isset($p6)?$p6:""?>&nbsp;&nbsp;</label><br><br>
    </td>
</tr>


<tr class="table2">
<td class="table2">
    <label for="p1" class="form-label">¿Cuantas veces se lava los dientes?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p13" class="form-label"><?php echo isset($p10)?$p10:""?></label><br><br>
    </td>

    <td class="table2">
    <label for="p8" class="form-label">¿Está embarazada? </label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p6" class="form-label"><?php echo isset($p7)?$p7:"" ?>&nbsp;&nbsp;</label><br><br>
    </td>
</tr>


<tr class="table2">
<td class="table2">
    <label for="p1" class="form-label">¿Le sangran las encías?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p13" class="form-label"><?php echo isset($p11)?$p11:""?></label><br><br>
    </td>

    <td class="table2">
    <label for="p8" class="form-label">¿Fuma? </label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p6" class="form-label"><?php echo isset($p9)?$p9:"" ?>&nbsp;&nbsp;</label><br><br>
    </td>
</tr>

<tr class="table2">
<td class="table2">
    <label for="p12" class="form-label">¿Última visita al odontólogo?</label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p12" class="form-label"><?php echo isset($p12)?$p12:""?></label><br><br>
    </td>

    <td class="table2">
    <label for="p14" class="form-label">¿Presión Arterial? </label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p14" class="form-label"><?php echo isset($p14)?$p14:"" ?>&nbsp;&nbsp;</label><br><br>
    </td>
</tr>

<tr class="table2">
<td class="table2">
    <label for="p15" class="form-label">¿Sufre de Herpes o aftas recurrentes? </label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p15" class="form-label"><?php echo isset($p15)?$p15:"" ?></label><br><br>
    </td>

    <td class="table2">
    <label for="p16" class="form-label">¿Antecedentes familiares de importancia? </label><br><br>
    </td>

    <td colspan="2" align="center" class="table2">
    <label for="p16" class="form-label"><?php echo isset($p16)?$p16:"" ?>&nbsp;&nbsp;</label><br><br>
    </td>
</tr>
</table>



<br><br><br>

<table>
<tr>
    <td>
    <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/proySanFranciscoPHP/images/odontograma.jpg" alt="5" width="750" sizes="" srcset="">
    </td>
</tr>
</table>


<table>
<tr>
    <td>
    <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/proySanFranciscoPHP/images/hrmorado.jpg" alt="5" width="725" sizes="" srcset="">
    </td>
</tr>
</table>

<table>
    <tr>
        <td><b>DX: </b> <?php echo $dx?></td> 
    </tr>

    <tr>
        <td><b> Plan del Tratamiento:</b></td>
    </tr>

    <tr>
        <td><?php echo $comentarios?></td>
    </tr>
</table>

<br><br><br><br>
<table>
<tr>
    <td>
    <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/proySanFranciscoPHP/images/tratamiento.jpg" alt="5" width="725" sizes="" srcset="">
    </td>
</tr>

</table>

<table class="table2" align="center">

<tr class="table2">
    <td class="table2">
    <label for="" class="form-label"> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <b> Fecha </b>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br><br>
    </td>

    <td class="table2">
    <label for="" class="form-label">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <b>Descripción de Cita </b>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br><br>
    </td>

    <td class="table2">
    <label for="" class="form-label">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Total</b>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br><br>
    </td>

    <td class="table2">
    <label for="" class="form-label">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <b>A cuenta</b>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br><br>
    </td>

    <td class="table2">
    <label for="" class="form-label">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Saldo</b>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br><br>
    </td>

</tr>

<?php foreach($lista_atenciones as $atencion){ 
    
    if($atencion['modalidad']=='Presencial' && $atencion['estado']=='Asistencia'){?>
    
<tr class="table2" align="center">
    
    <td class="table2">
    <label for="" class="form-label"> <?php echo $atencion['fecha_inicio']?> </label><br><br>
    </td>

    <td class="table2">
    <label for="" class="form-label"><?php echo $atencion['evento']?></label><br><br>
    </td>

    <td class="table2">
    <label for="" class="form-label">S/100.00</label><br><br>
    </td>

    <td class="table2">
    <label for="" class="form-label">S/50.00</label><br><br>
    </td>

    <td class="table2">
    <label for="" class="form-label">S/50.00</label><br><br>
    </td>
</tr>

<?php }} ?>
</table>





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