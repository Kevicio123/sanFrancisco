<?php 
include ("../../db.php");

if($_POST){
    // Recolectamos los datos
    $especialidad=(isset($_POST["especialidad"])?$_POST["especialidad"]:"");
    $detalle=(isset($_POST["detalle"])?$_POST["detalle"]:"");

    // Insertamos los datos a la BD
    $sentencia=$conexion->prepare("INSERT INTO especialidad(idEsp,especialidad,detalle)
            VALUES(null,:especialidad,:detalle)");
    
    // Asignando los valores del formulario
    $sentencia->bindParam(":especialidad",$especialidad);
    $sentencia->bindParam(":detalle",$detalle);
    $sentencia->execute();
    header("Location: index.php");

}


?>


<?php include("../../templates/header.php");?>
    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Crear Especialidades</h3>


    <div class="col-md-6">
    <label for="especialidad" class="form-label">Especialidad</label>
    <input type="text" class="form-control" id="especialidad" name="especialidad">
    </div>

    <div class="col-md-6">
    <label for="detalle" class="form-label">Detalle</label>
    <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Detalle de Especialidad">
    </div>

    <div class="col-12">
    <button type="submit" class="btn btn-success">Registrar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>

    </form>







<?php include("../../templates/footer.php");?>