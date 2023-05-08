<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

require('config.php');

$idEvento         = $_POST['idEvento'];
                        
$evento            = ucwords($_REQUEST['evento']);
$f_inicio          = $_REQUEST['fecha_inicio'];
$fecha_inicio      = date('Y-m-d', strtotime($f_inicio)); 

$f_fin             = $_REQUEST['fecha_fin']; 
$seteando_f_final  = date('Y-m-d', strtotime($f_fin));  
$fecha_fin1        = strtotime($seteando_f_final);
$fecha_fin         = date('Y-m-d', ($fecha_fin1));  


$hora              = $_REQUEST['horainicio'];
$horainicio        = date('H:i:s', strtotime($hora));


$estado              = $_REQUEST['estado'];



$color_evento      = $_REQUEST['color_evento'];

$UpdateProd = ("UPDATE eventoscalendar 
    SET evento ='$evento',
        color_evento ='$color_evento',
        fecha_inicio ='$fecha_inicio',
        horainicio ='$horainicio',
        estado ='$estado',
        fecha_fin ='$fecha_fin'

    WHERE id='".$idEvento."' ");
$result = mysqli_query($con, $UpdateProd);

header("Location:index.php?ea=1");
?>