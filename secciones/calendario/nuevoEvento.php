<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
//$hora = date("g:i:A");

require("config.php");
$evento            = ucwords($_REQUEST['evento']);

$f_inicio          = $_REQUEST['fecha_inicio'];
$fecha_inicio      = date('Y-m-d', strtotime($f_inicio)); 

$f_fin             = $_REQUEST['fecha_fin']; 
$seteando_f_final  = date('Y-m-d', strtotime($f_fin));  

$fecha_fin1        = strtotime($seteando_f_final."+ 1 days");
$fecha_fin         = date('Y-m-d', ($fecha_fin1));  

$hora              = $_REQUEST['horainicio'];
$horainicio        = date('H:i:s', strtotime($hora));

$linkAten          = $_REQUEST['linkAten'];
$modalidad         = $_REQUEST['modalidad'];
$estado            = $_REQUEST['estado'];

$idPaciente        = $_REQUEST['idPaciente'];
$idDoctor          = $_REQUEST['idDoctor'];

$color_evento      = $_REQUEST['color_evento'];


$InsertNuevoEvento = "INSERT INTO eventoscalendar(
      evento,
      fecha_inicio,
      horainicio,
      linkAten,
      modalidad,
      estado,
      idPaciente,
      idDoctor,
      color_evento,
      fecha_fin
      )
    VALUES (
      '" .$evento. "',
      '". $fecha_inicio."',
      '" .$horainicio. "',
      '" .$linkAten. "',
      '" .$modalidad. "',
      '" .$estado. "',
      '" .$idPaciente. "',
      '" .$idDoctor. "',
      '" .$color_evento. "',
      '" .$fecha_fin. "'
  )";
$resultadoNuevoEvento = mysqli_query($con, $InsertNuevoEvento);

header("Location:index.php?e=1");

?>