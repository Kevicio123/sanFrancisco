<?php 
include ("../../db.php");
?>

<?php 

session_start();
$user_session=$_SESSION['correo'];
$paciente2 = $conexion->prepare
("SELECT * FROM users 
WHERE correo = '$user_session'");
$paciente2->execute();
$pacientes2=$paciente2->fetchAll(PDO::FETCH_ASSOC);


foreach($pacientes2 as $paciente ){
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
<?php $url_base="http://localhost/proySanFranciscoPHP/";?>

<div class="row align-items-md-stretch" align="center">
    
        <h3><br>
        <br>Panel de Reportes</h3>
        
        
        <div class="col-md-6">
            
            <br>
            <br><br>
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/reportes/pacientes.php" target="_blank">
            <img class="card-img-top" src="../../images/administrador/paciente.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center" style="font">Reporte de Pacientes</h4>
            </a>
            </div>
            </div>  
        </div>
        <div class="col-md-6">
            <br>
            <br><br>
            <a href="<?php echo $url_base?>secciones/reportes/doctores.php" target="_blank" >
            <div class="card" style="width: 16rem;">
            <img class="card-img-top" src="../../images/administrador/doctores.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Reporte de Doctores</h4>
            </a>
            </div>
            </div>  
            <br><br><br>       
        </div>
        
       <?php if($rol==1){ ?>
        <a href="<?php echo $url_base;?>" class="btn btn-primary" type="button"> Regresar al Menú Principal</a>
        
        <a href="<?php echo $url_base;?>secciones/tratamiento/" class="btn btn-success" type="button"> Siguiente Módulo</a>
        
        <?php } else if($rol==2){?>
        
        <a href="../../index2.php" class="btn btn-primary" type="button"> Regresar al Menú Principal</a>
        
        <a href="<?php echo $url_base;?>secciones/chatbot/" class="btn btn-success" type="button"> Siguiente Módulo</a>

        <?php } ?>
</div>


<?php
        include("../../templates/footer.php");         
    
?>