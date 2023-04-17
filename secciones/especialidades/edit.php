<?php 
include ("../../db.php");

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `especialidad` WHERE idEsp=:idEsp");
    $sentencia->bindParam(":idEsp",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $especialidad=$registro["especialidad"];
    $detalle=$registro["detalle"];
}

// Intrucción de recolección de datos

if($_POST){
    // Recolectamos los datos
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $especialidad=(isset($_POST["especialidad"])?$_POST["especialidad"]:"");
    $detalle=(isset($_POST["detalle"])?$_POST["detalle"]:"");

    // Actualizamos los datos de la BD
    $sentencia=$conexion->prepare("UPDATE especialidad 
    SET especialidad=:especialidad, detalle=:detalle
    WHERE idEsp=:idEsp");
 
    // Asignando los valores del formulario y txtID
    $sentencia->bindParam(":especialidad",$especialidad);
    $sentencia->bindParam(":detalle",$detalle);
    $sentencia->bindParam(":idEsp",$txtID);
    $sentencia->execute();

    header("Location: index.php");
}

?>

<?php include("../../templates/header.php");?>
    <br>
    <br>

    
    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Editar Especialidad</h3>

    <div class="visually-hidden-focusable">
    <label for="especialidad" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="txtID" name="txtID">
    </div>

    <div class="col-md-6">
    <label for="especialidad" class="form-label">Especialidad</label>
    <input value="<?php echo $especialidad;?>" 
    type="text" class="form-control" id="especialidad" name="especialidad">
    </div>

    <div class="col-md-6">
    <label for="detalle" class="form-label">Detalle</label>
    <input value="<?php echo $detalle;?>" 
    type="text" class="form-control" id="detalle" name="detalle" placeholder="Detalle de Especialidad">
    </div>

    <div class="col-12">
    <button type="submit" class="btn btn-success">Editar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Cancelar</a>
    </div>

    </form>





<?php include("../../templates/footer.php");?>

