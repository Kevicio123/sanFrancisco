<?php 
include ("../../db.php");

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `doctor` WHERE idDoctor=:idDoctor");
    $sentencia->bindParam(":idDoctor",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $dni=$registro["dni"];
    $nombres=$registro["nombres"];
    $apePat=$registro["apePat"];
    $apaeMat=$registro["apaeMat"];
    $sexo=$registro["sexo"];
    $fechaNac=$registro["fechaNac"];
    $direccion=$registro["direccion"];
    $distrito=$registro["distrito"];
    $celular=$registro["celular"];
    $idEsp=$registro["idEsp"];
    $idUser=$registro["idUser"];
}

// Intrucción de recolección de datos

if($_POST){
    // Recolectamos los datos
  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
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

    // Actualizamos los datos de la BD
    $sentencia=$conexion->prepare
  ("UPDATE doctor SET
  dni=:dni,
  nombres=:nombres,
  apePat=:apePat,
  apaeMat=:apaeMat,
  sexo=:sexo,
  fechaNac=:fechaNac,
  direccion=:direccion,
  distrito=:distrito,
  celular=:celular,
  idEsp=:idEsp,
  idUser=:idUser
  WHERE idDoctor=:idDoctor");

 
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
  $sentencia->bindParam(":idDoctor",$txtID);
  $sentencia->execute();

    $mensaje="Doctor Actualizado correctamente";
    header("Location:index.php?mensaje=".$mensaje);
}

  $sentencia=$conexion->prepare("SELECT * FROM `users`");
  $sentencia->execute();
  $lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

  $sentencia=$conexion->prepare("SELECT * FROM `especialidad`");
  $sentencia->execute();
  $especialidades=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include("../../templates/header.php");?>
    <br>
    <br>
    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Actualizar Datos del Doctor</h3>

    <div class="visually-hidden-focusable">
    <label for="especialidad" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="txtID" name="txtID">
    </div>

    <div class="col-md-6">
    <label for="dni" class="form-label">DNI</label>
    <input type="char" class="form-control" id="dni" name="dni"
    value="<?php echo $dni;?>">
    </div>

    <div class="col-md-6">
    <label for="nombres" class="form-label">Nombres</label>
    <input type="text" class="form-control" id="nombres" name="nombres"
    value="<?php echo $nombres;?>">
    </div>

    <div class="col-md-6">
    <label for="apePat" class="form-label">Apellido Paterno</label>
    <input type="text" class="form-control" id="apePat" name="apePat"
    value="<?php echo $apePat;?>">
    </div>

    <div class="col-md-6">
    <label for="apaeMat" class="form-label">Apellido Materno</label>
    <input type="text" class="form-control" id="apaeMat" name="apaeMat"
    value="<?php echo $apaeMat;?>">
    </div>

    <div class="col-md-4">
    <label for="sexo" class="form-label">Sexo</label>
    <select id="sexo" name="sexo" class="form-select">
    <option <?php echo('sexo')?"selected":"";?>
      value="<?php echo $sexo; ?>">
      <?php echo $sexo; ?></option>
      <option value="Masculino">Masculino</option>
      <option value="Femenino">Femenino</option>
    </select>
    </div>

    <div class="col-md-4">
    <label for="idEsp" class="form-label">Especialidad</label>
    
    <select id="idEsp" name="idEsp" class="form-select">
    <option selected>Especialidad</option>
    <?php foreach($especialidades as $especialidad)            
    { ?>

      <option <?php echo($idEsp==$especialidad['idEsp'])?"selected":"";?>
      value="<?php echo $especialidad['idEsp']; ?>">
        <?php echo $especialidad['especialidad']; ?>
      </option>


    <?php } ?>
    </select>
    </div>


    <div class="col-md-4">
    <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
    <input type="date" class="form-control" id="fechaNac" name="fechaNac"
    value="<?php echo $fechaNac;?>">
    </div>

    <div class="col-md-4">
    <label for="direccion" class="form-label">Direccion</label>
    <input type="text" class="form-control" id="direccion" name="direccion"
    value="<?php echo $direccion;?>">
    </div>


    <div class="col-md-4">
    <label for="distrito" class="form-label">Distrito</label>
    <select id="distrito" name="distrito" class="form-select">
    <option <?php echo('distrito')?"selected":"";?>
      value="<?php echo $distrito; ?>">
      <?php echo $distrito; ?></option>
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
    <input type="char" class="form-control" id="celular" name="celular" placeholder="(+51)"
    value="<?php echo $celular;?>">
    </div>

    <div class="col-4">
    <label for="idUser" class="form-label">Usuario</label>
    <select id="idUser" name="idUser" class="form-select">
    <option selected>Usuario</option>
    <?php foreach($lista_usuarios as $usuario)            
    { ?>
      <option <?php echo($idUser==$usuario['idUser'])?"selected":"";?>
      value="<?php echo $usuario['idUser']; ?>">
        <?php echo $usuario['correo']; ?>
      </option>
    <?php } ?>
    </select>
    </div>

    


    <div class="col-12">
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>


    </form>





<?php include("../../templates/footer.php");?>