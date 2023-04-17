<?php

$server="localhost"; 
$db="mydb";
$username="root";
$password="";

try{
    $conexion= new PDO("mysql:host=$server;dbname=$db",$username, $password);
}catch(Exception $ex){
    echo $ex->getMessage();
    
}
?>