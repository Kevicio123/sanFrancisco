<?php include("../templates/Paciente/header.php");?>

<?php include("../db.php");?>


<div class="container">
<br>
<div class="row"> 
<div>
<h2>Manual del Usuario</h2>
</div>

<div class="alert alert-dismissible alert-light">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Sección de Manual.</strong> Descarga el presente PDF haciendo click encima de la imagen, para que tenga información sobre el uso de la plataforma.
</div>

<div class="col-md-3"> 
<a href="<?php echo $url_base?>doctor/Manual PDF.pdf" download="manualDescarga" >
<img class="card-img-top" src="../images/PDF.png" alt="Card image cap"  style="width: 70px; height: 90px;">
&nbsp;  &nbsp; Documento Manual
</a>
</div>







</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>


<?php include("../templates/Paciente/footer.php");?>
