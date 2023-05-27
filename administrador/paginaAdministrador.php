<?php include("../templates/header.php");?>

<?php include("../db.php");?>

<?php include("../principal.php");?>

<br><br><br><br>
<div class="container">
    <div class="row">

    <div class="col-md-6">
        <br><br><br><br><br><br><br>
        <h1>Bienvenido Administrador </h1> 
        <h3><?php echo $correoA?></h3>  
        <br>
        <a class="btn btn-dark" type="button" href="../index.php">Empieza a Navegar</a>
    </div>

    <div class="col-md-6">
        <br><br>
        <img src="../images/admin.png" alt="">
    </div>   
    
    
    </div>
</div>



<?php include("../templates/Paciente/footer.php");?>