<?php 
include ("../db.php");

if($_POST){
    // Recolectamos los datos
    $asunto=(isset($_POST["asunto"])?$_POST["asunto"]:"");
    $detalle=(isset($_POST["detalle"])?$_POST["detalle"]:"");

    // Insertamos los datos a la BD
    $sentencia=$conexion->prepare("INSERT INTO sugerencias(idSug,asunto,detalle)
            VALUES(null,:asunto,:detalle)");
    
    // Asignando los valores del formulario
    $sentencia->bindParam(":asunto",$asunto);
    $sentencia->bindParam(":detalle",$detalle);
    $sentencia->execute();
    $mensaje="Sugerencia Enviada con Éxito";
    header("Location:../index3.php?mensaje=".$mensaje);
}

?>


<?php 
$url_index="http://localhost/proySanFranciscoPHP/"; 
?>

<?php include("../templates/Paciente/header.php");?>


<br>
    <br>
    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Envío de Sugerencias</h3>

    <div class="alert alert-dismissible alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Sección de Sugerencias!</strong> Envíanos tus sugerencias para poder mejorar.
    </div>


    <div class="col-md-6">
    <label for="asunto" class="form-label">Título de la Sugerencia</label>
    <input type="text" class="form-control" id="asunto" name="asunto">
    </div>
    <br>


    <div class="col-md-12">
    <label for="detalle" class="form-label">Detalle</label>
    <input type="text" class="form-control" id="detalle" name="detalle" >
    </div>

    <div class="col-12">
    <button type="submit" class="btn btn-success">Enviar</button>
    <a href="<?php echo $url_index?>index3.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>
    </form>






<?php include("../templates/Paciente/footer.php");?>