<?php 
include ("../../db.php");

if($_POST){
    // Recolectamos los datos
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
    $contrasenia=(isset($_POST["contrasenia"])?$_POST["contrasenia"]:"");
    $idRoles=(isset($_POST["idRoles"])?$_POST["idRoles"]:"");

    // Insertamos los datos a la BD
    $sentencia=$conexion->prepare("INSERT INTO users(idUser,correo,contrasenia,idRoles)
            VALUES(null,:correo,:contrasenia,:idRoles)");
    
    // Asignando los valores del formulario
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":contrasenia",$contrasenia);
    $sentencia->bindParam(":idRoles",$idRoles);
    $sentencia->execute();
    $mensaje="Usuario Agregado";
    header("Location:index.php?mensaje=".$mensaje);
}

    $sentencia=$conexion->prepare("SELECT * FROM `rol`");
    $sentencia->execute();
    $lista_roles=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>



<?php include("../../templates/header.php");?>
    <br>
    <br>
    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Datos del Usuario</h3>

    <div class="col-md-6">
    <label for="correo" class="form-label">Correo Electrónico</label>
    <input type="email" class="form-control" id="correo" name="correo">
    </div>


    <div class="col-md-6">
    <label for="contrasenia" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="contrasenia" name="contrasenia" >
    </div>

    
    <div class="col-md-6">
    <label for="idRoles" class="form-label">Especialidad</label>
    
    <select id="idRoles" name="idRoles" class="form-select">
    <option selected>Rol del Usuario</option>
    <?php foreach($lista_roles as $rol)            
    { ?>
      <option value="<?php echo $rol['idRoles']; ?>">
        <?php echo $rol['n_Rol']; ?>
      </option>
    <?php } ?>
    </select>
    </div>



    <div class="col-12">
    <button type="submit" class="btn btn-success">Registrar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>

    </form>

  






<?php include("../../templates/footer.php");?>