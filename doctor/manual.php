<?php include("../templates/Doctor/header.php");?>

<?php include("../db.php");?>

<?php include("../principal2.php");?>


<div class="container">
<br>
<div class="row"> 

<h2 >Manual del Usuario</h2>
<br><br><br>
<div class="alert alert-dismissible alert-light">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Sección de Manual.</strong> Descarga el presente PDF haciendo click encima de la imagen, de modo que tenga información sobre el uso de la plataforma.
</div>

<div class="col-md-4"> 
<a href="<?php echo $url_base?>doctor/Manual PDF.pdf" download="manualDescarga" >
<img class="card-img-top" src="../images/PDF.png" alt="Card image cap"  style="width: 70px; height: 90px;">
<label for=""> &nbsp;  &nbsp; Documento Manual</label>
</a>
</div>

<br>
<div>
<br><br>
    <a href="../index2.php" type="button" class="btn btn-secondary">Regresar Menú Principal</a>
</div>

