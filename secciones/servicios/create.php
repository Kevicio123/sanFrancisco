<?php 
include ("../../db.php");

if($_POST){
    // Recolectamos los datos
    $servicio=(isset($_POST["nomSer"])?$_POST["nomSer"]:"");
    $detalle=(isset($_POST["detalle"])?$_POST["detalle"]:"");

    // Insertamos los datos a la BD
    $sentencia=$conexion->prepare("INSERT INTO tiposervicio(idTipSer,nomSer,detalle)
            VALUES(null,:servicio,:detalle)");
    
    // Asignando los valores del formulario
    $sentencia->bindParam(":servicio",$servicio);
    $sentencia->bindParam(":detalle",$detalle);
    $sentencia->execute();
    $mensaje="Servicio Agregado Correctamente";
    header("Location:index.php?mensaje=".$mensaje);

}


?>



<?php include("../../templates/header.php");?>
    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Crear Servicio Médico</h3>

    <div class="col-md-6">
    <label for="nomSer" class="form-label">Nombre del Servicio</label>
    <input type="text" class="form-control" id="nomSer" name="nomSer">
    </div>

    <div class="col-md-6">
    <label for="detalle" class="form-label">Detalle</label>
    <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Detalle del Servicio">
    </div>

    <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>

    </form>






<?php include("../../templates/footer.php");?>