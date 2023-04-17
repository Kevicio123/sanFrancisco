<?php 
include ("../../db.php");

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `paciente` WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
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
    $lugarNac=$registro["lugarNac"];
    $telefono=$registro["telefono"];
    $celular=$registro["celular"];
    $edad=$registro["edad"];
    $hisoriaClinic=$registro["hisoriaClinic"];
    $idUser=$registro["idUser"];

}

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
  $lugarNac=(isset($_POST["lugarNac"])?$_POST["lugarNac"]:"");
  $telefono=(isset($_POST["telefono"])?$_POST["telefono"]:"");
  $celular=(isset($_POST["celular"])?$_POST["celular"]:"");
  $edad=(isset($_POST["edad"])?$_POST["edad"]:"");
  $idUser=(isset($_POST["idUser"])?$_POST["idUser"]:"");


  // Insertamos los datos a la BD
  $sentencia=$conexion->prepare
  ("UPDATE paciente SET
  dni=:dni,
  nombres=:nombres,
  apePat=:apePat,
  apaeMat=:apaeMat,
  sexo=:sexo,
  fechaNac=:fechaNac,
  direccion=:direccion,
  distrito=:distrito,
  lugarNac=:lugarNac,
  telefono=:telefono,
  celular=:celular,
  edad=:edad,
  idUser=:idUser
  WHERE idPaciente=:idPaciente");

  // Asignando los valores del formulario
  $sentencia->bindParam(":dni",$dni);
  $sentencia->bindParam(":nombres",$nombres);
  $sentencia->bindParam(":apePat",$apePat);
  $sentencia->bindParam(":apaeMat",$apaeMat);
  $sentencia->bindParam(":sexo",$sexo);
  $sentencia->bindParam(":fechaNac",$fechaNac);
  $sentencia->bindParam(":direccion",$direccion);
  $sentencia->bindParam(":distrito",$distrito);
  $sentencia->bindParam(":lugarNac",$lugarNac);
  $sentencia->bindParam(":telefono",$telefono);
  $sentencia->bindParam(":celular",$celular);
  $sentencia->bindParam(":edad",$edad);
  $sentencia->bindParam(":idUser",$idUser);
  $sentencia->bindParam(":idPaciente",$txtID);
  $sentencia->execute();
    $mensaje="Paciente Actualizado correctamente";
    header("Location:index.php?mensaje=".$mensaje);
  

}

    $sentencia=$conexion->prepare("SELECT * FROM `users`");
  $sentencia->execute();
  $lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>


<?php 

session_start();
$user_session=$_SESSION['correo'];
$paciente = $conexion->prepare
("SELECT * FROM users 
WHERE correo = '$user_session'");
$paciente->execute();
$pacientes=$paciente->fetchAll(PDO::FETCH_ASSOC);


foreach($pacientes as $paciente ){
    $rol=$paciente['idRoles'];
}

?>

<?php
    if($rol==1){
        include("../../templates/header.php");   
    }else if($rol==2){
        include("../../templates/Doctor/header.php");
    }
?>

    <br>
    <br>

    <form action="" method="post" class="row g-3" enctype="multipart/form-data">

    <h3>Actualizar Datos del Paciente</h3>

    <div class="visually-hidden-focusable">
    <label for="especialidad" class="form-label">ID</label>
    <input value="<?php echo $txtID;?>"
    type="text" class="form-control" id="txtID" name="txtID">
    </div>

    <div class="col-md-6">
    <label for="dni" class="form-label">DNI</label>
    <input type="char" value="<?php echo $dni;?>" class="form-control" id="dni" name="dni">
    </div>

    <div class="col-md-6">
    <label for="nombres" class="form-label">Nombres</label>
    <input type="text" value="<?php echo $nombres;?>" class="form-control" id="nombres" name="nombres">
    </div>

    <div class="col-md-6">
    <label for="apePat" class="form-label">Apellido Paterno</label>
    <input type="text" value="<?php echo $apaeMat;?>" class="form-control" id="apePat" name="apePat">
    </div>

    <div class="col-md-6">
    <label for="apaeMat" class="form-label">Apellido Materno</label>
    <input type="text" value="<?php echo $apePat;?>" class="form-control" id="apaeMat" name="apaeMat">
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


    </div>

    <div class="col-md-4">
    <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
    <input type="date" value="<?php echo $fechaNac;?>" class="form-control" id="fechaNac" name="fechaNac">
    </div>

    <div class="col-md-4">
    <label for="direccion" class="form-label">Direccion</label>
    <input type="text" value="<?php echo $direccion;?>" class="form-control" id="direccion" name="direccion">
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

    <div class="col-md-4">
    <label for="lugarNac" class="form-label">Lugar de Nacimiento</label>
    <select id="lugarNac" name="lugarNac" class="form-select">
    <option <?php echo('lugarNac')?"selected":"";?>
      value="<?php echo $lugarNac; ?>">
      <?php echo $lugarNac; ?></option>
      <option value="Lima">Lima</option>
      <option value="Tacna">Tacna</option>
      <option value="Junin">Junín</option>
      <option value="La Libertad">La Libertad</option>
      <option value="Lambayeque">Lambayeque</option>
      <option value="Cusco">Cusco</option>
      <option value="Cajamarca">Cajamarca</option>
      <option value="San Isidro">San Isidro</option>
      <option value="Ayacucho">Ayacucho</option>
      <option value="Arequipa">Arequipa</option>
      <option value="Apurimac">Apurímac</option>
    </select>
    </div>


    <div class="col-4">
    <label for="telefono" class="form-label">Teléfono</label>
    <input type="tel" value="<?php echo $telefono;?>" class="form-control" id="telefono" name="telefono" placeholder="(01) 356-4551">
    </div>



    <div class="col-4">
    <label for="celular" class="form-label">Celular</label>
    <input type="tel" value="<?php echo $celular;?>" class="form-control" id="celular" name="celular" placeholder="(+51)">
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

    <div class="col-md-4">
    <label for="edad" class="form-label">Edad</label>
    <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $edad;?>">
    </div>



    <div class="col-12">
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php" type="button"  class="btn btn-dark">Regresar</a>
    </div>


    </form>





<?php include("../../templates/footer.php");?>