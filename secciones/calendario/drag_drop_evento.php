<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include('config.php');
                        
$idEvento         = $_POST['idEvento'];
$start            = $_REQUEST['start'];
$fecha_inicio     = date('Y-m-d', strtotime($start)); 
$end              = $_REQUEST['end']; 
$fecha_fin        = date('Y-m-d', strtotime($end));  
$hora             = $_REQUEST['hora']; 
$horainicio       = date('g:i:A', strtotime($hora)); 


$UpdateProd = ("UPDATE eventoscalendar 
    SET 
        fecha_inicio ='$fecha_inicio',
        fecha_fin ='$fecha_fin',
        horainicio='$horainicio'

    WHERE id='".$idEvento."' ");
$result = mysqli_query($con, $UpdateProd);

?>