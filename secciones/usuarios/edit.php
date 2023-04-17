<?php 
include ("../../db.php");

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `users` WHERE idUser=:idUser");
    $sentencia->bindParam(":idUser",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $correo=$registro["correo"];
    $contrasenia=$registro["contrasenia"];
    $idRoles=$registro["idRoles"];
}

// Intrucción de recolección de datos

if($_POST){
    // Recolectamos los datos
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
    $contrasenia=(isset($_POST["contrasenia"])?$_POST["contrasenia"]:"");
    $idRoles=(isset($_POST["idRoles"])?$_POST["idRoles"]:"");

    // Actualizamos los datos de la BD
    $sentencia=$conexion->prepare("UPDATE users SET 
        correo=:correo, 
        contrasenia=:contrasenia,
        idRoles=:idRoles 
        WHERE idUser=:idUser
    ");

 
    // Asignando los valores del formulario y txtID
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":contrasenia",$contrasenia);
    $sentencia->bindParam(":idRoles",$idRoles);
    $sentencia->bindParam(":idUser",$txtID);
    $sentencia->execute();

    $mensaje="Usuario Actualizado correctamente";
    header("Location:index.php?mensaje=".$mensaje);
}

?>


<?php include("../../templates/header.php");?>
    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Editar Datos del Usuario</h3>

    <div class="visually-hidden-focusable">
    <label for="especialidad" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="txtID" name="txtID">
    </div>

    <div class="col-md-6">
    <label for="correo" class="form-label">Correo Electrónico</label>
    <input type="email" value="<?php echo $correo;?>" class="form-control" id="correo" name="correo">
    </div>

    <div class="col-md-6">
    <label for="contrasenia" class="form-label">Contraseña</label>
    <input type="password" value="<?php echo $contrasenia;?>" class="form-control" id="contrasenia" name="contrasenia" >
    </div>


    <div class="col-md-6">
    <label for="idRoles" class="form-label">Usuario Rol</label>
    <input type="text" value="<?php echo $idRoles;?>" class="form-control" id="idRoles" name="idRoles">
    </div>


    <div class="col-12">
    <button type="submit" class="btn btn-success">Actualizar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>

    </form>






<?php include("../../templates/footer.php");?>