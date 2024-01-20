<?php include("../templates/Doctor/header.php");?>

<?php include("../db.php");?>

<?php include("../principal2.php");?>

<br><br><br><br>
<div class="container">
    <div class="row">

    <div class="col-md-6">
        <br><br><br><br><br><br><br>
        <h1>Bienvenida Odontólogo </h1> 
        <h3><?php echo $nombres?></h3>  
        <br>
        <a class="btn btn-dark" type="button" href="../index2.php">Empieza a Navegar</a>
    </div>

    <div class="col-md-6">
        <br><br>
        <img src="../images/bienvenido1.png" alt="">
    </div>   
    
    
    </div>
</div>



<?php include("../templates/Paciente/footer.php");?>