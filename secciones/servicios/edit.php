<?php 
include ("../../db.php");

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `tiposervicio` 
    WHERE idTipSer=:idTipSer");
    $sentencia->bindParam(":idTipSer",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $nomSer=$registro["nomSer"];
    $detalle=$registro["detalle"];
}

// Intrucción de recolección de datos

if($_POST){
    // Recolectamos los datos
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $nomSer=(isset($_POST["nomSer"])?$_POST["nomSer"]:"");
    $detalle=(isset($_POST["detalle"])?$_POST["detalle"]:"");

    // Actualizamos los datos de la BD
    $sentencia=$conexion->prepare("UPDATE tiposervicio SET 
        nomSer=:nomSer, 
        detalle=:detalle
        WHERE idTipSer=:idTipSer
    ");

 
    // Asignando los valores del formulario y txtID
    $sentencia->bindParam(":nomSer",$nomSer);
    $sentencia->bindParam(":detalle",$detalle);
    $sentencia->bindParam(":idTipSer",$txtID);
    $sentencia->execute();

    $mensaje="Servicio Actualizado correctamente";
    header("Location:index.php?mensaje=".$mensaje);
}

?>

<?php include("../../templates/header.php");?>
    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Actualizar Servicio Médico</h3>

    <div class="visually-hidden-focusable">
    <label for="especialidad" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="txtID" name="txtID">
    </div>

    <div class="col-md-6">
    <label for="nomSer" class="form-label">Nombre del Servicio</label>
    <input type="text" class="form-control" id="nomSer" name="nomSer"
    value="<?php echo $nomSer?>">
    </div>

    <div class="col-md-6">
    <label for="detalle" class="form-label">Detalle</label>
    <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Detalle del Servicio"
    value="<?php echo $detalle?>">
    </div>

    <div class="col-12">
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>

    </form>





<?php include("../../templates/footer.php");?>