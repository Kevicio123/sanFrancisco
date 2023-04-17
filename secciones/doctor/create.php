<?php
include ("../../db.php");

if($_POST){
    // Recolectamos los datos
    $dni=(isset($_POST["dni"])?$_POST["dni"]:"");
    $nombres=(isset($_POST["nombres"])?$_POST["nombres"]:"");
    $apePat=(isset($_POST["apePat"])?$_POST["apePat"]:"");
    $apaeMat=(isset($_POST["apaeMat"])?$_POST["apaeMat"]:"");
    $sexo=(isset($_POST["sexo"])?$_POST["sexo"]:"");
    $fechaNac=(isset($_POST["fechaNac"])?$_POST["fechaNac"]:"");
    $direccion=(isset($_POST["direccion"])?$_POST["direccion"]:"");
    $distrito=(isset($_POST["distrito"])?$_POST["distrito"]:"");
    $celular=(isset($_POST["celular"])?$_POST["celular"]:"");
    $idEsp=(isset($_POST["idEsp"])?$_POST["idEsp"]:"");
    $idUser=(isset($_POST["idUser"])?$_POST["idUser"]:"");


    // Insertamos los datos a la BD
    $sentencia=$conexion->prepare
    ("INSERT INTO doctor(idDoctor,dni,nombres,apePat,apaeMat,sexo
    ,fechaNac,direccion,distrito,celular,idEsp,idUser)
    VALUES(null,:dni,:nombres,:apePat,:apaeMat,:sexo,:fechaNac,
    :direccion,:distrito,:celular,:idEsp,:idUser)");

    
    // Asignando los valores del formulario
    $sentencia->bindParam(":dni",$dni);
    $sentencia->bindParam(":nombres",$nombres);
    $sentencia->bindParam(":apePat",$apePat);
    $sentencia->bindParam(":apaeMat",$apaeMat);
    $sentencia->bindParam(":sexo",$sexo);
    $sentencia->bindParam(":fechaNac",$fechaNac);
    $sentencia->bindParam(":direccion",$direccion);
    $sentencia->bindParam(":distrito",$distrito);
    $sentencia->bindParam(":celular",$celular);
    $sentencia->bindParam(":idEsp",$idEsp);
    $sentencia->bindParam(":idUser",$idUser);
    $sentencia->execute();
    header("Location: index.php");

}

  $sentencia=$conexion->prepare("SELECT * FROM `users`");
  $sentencia->execute();
  $lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

  $sentencia=$conexion->prepare("SELECT * FROM `especialidad`");
  $sentencia->execute();
  $lista_especialidades=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>



<?php include("../../templates/header.php");?>
    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Datos del Doctor</h3>

    <div class="col-md-6">
    <label for="dni" class="form-label">DNI</label>
    <input type="char" class="form-control" id="dni" name="dni" required>
    </div>

    <div class="col-md-6">
    <label for="nombres" class="form-label">Nombres</label>
    <input type="text" class="form-control" id="nombres" name="nombres" required>
    </div>

    <div class="col-md-6">
    <label for="apePat" class="form-label">Apellido Paterno</label>
    <input type="text" class="form-control" id="apePat" name="apePat" required>
    </div>

    <div class="col-md-6">
    <label for="apaeMat" class="form-label">Apellido Materno</label>
    <input type="text" class="form-control" id="apaeMat" name="apaeMat" required>
    </div>

    <div class="col-md-4">
    <label for="sexo" class="form-label">Sexo</label>
    <select id="sexo" name="sexo" class="form-select">
      <option value="Masculino">Masculino</option>
      <option value="Femenino">Femenino</option>
    </select>
    </div>

    <div class="col-md-4">
    <label for="idUser" class="form-label">Especialidad</label>
    
    <select id="idEsp" name="idEsp" class="form-select" required>
    <option selected>Especialidad</option>
    <?php foreach($lista_especialidades as $especialidad)            
    { ?>
      <option value="<?php echo $especialidad['idEsp']; ?>">
        <?php echo $especialidad['especialidad']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    

    <div class="col-md-4">
    <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
    <input type="date" class="form-control" id="fechaNac" name="fechaNac" required>
    </div>

    <div class="col-md-4">
    <label for="direccion" class="form-label">Direccion</label>
    <input type="text" class="form-control" id="direccion" name="direccion" required>
    </div>


    <div class="col-md-4">
    <label for="distrito" class="form-label">Distrito</label>
    <select id="distrito" name="distrito" class="form-select" required>
      <option selected>Seleccione</option>
      <option value="Cercado de Lima">Cercado de Lima</option>
      <option value="Miraflores">Miraflores</option>
      <option value="La Molina">La Molina</option>
      <option value="San Luis">San Luis</option>
      <option value="San Borja">San Borja</option>
      <option value="San Miguel">San Miguel</option>
      <option value="Santa Anita">Santa Anita</option>
      <option value="San Isidro">San Isidro</option>
      <option value="Pueblo Libre">Pueblo Libre</option>
      <option value="Puente Piedra">Puente Piedra</option>
      <option value="Ventanilla">Ventanilla</option>
    </select>
    </div>


    <div class="col-4">
    <label for="celular" class="form-label">Celular</label>
    <input type="char" class="form-control" id="celular" name="celular" placeholder="(+51)" required>
    </div>

    <div class="col-4">
    <label for="idUser" class="form-label">Usuario</label>
    <select id="idUser" name="idUser" class="form-select" required>
    <option selected>Usuario</option>
    <?php foreach($lista_usuarios as $usuario)            
    { ?>
      <option value="<?php echo $usuario['idUser']; ?>">
        <?php echo $usuario['correo']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    


    <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>


    </form>





<?php include("../../templates/footer.php");?>