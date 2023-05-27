<?php include("../templates/Paciente/header.php");?>

<?php include("../db.php");?>

<?php include("../principal.php");?>

<br><br><br><br>
<div class="container">
    <div class="row">

    <div class="col-md-6">
        <br><br><br><br><br><br><br>
        <h1>Bienvenido Paciente </h1> 
        <h3><?php echo $nombres?></h3>  
        <br>
        <a class="btn btn-dark" type="button" href="../index3.php">Empieza a Navegar</a>
        
        
    </div>

    <div class="col-md-6" align="left">
        <br><br>
        <img src="../images/paciente.png" alt="">
    </div>   
    
    
    </div>
</div>



<?php include("../templates/Paciente/footer.php");?>