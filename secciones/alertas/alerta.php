<?php
session_start();
include ("../../db.php");
$user_session=$_SESSION['correo'];
$paciente = $conexion->prepare
("SELECT * FROM users 
WHERE correo = '$user_session'");
$paciente->execute();
$pacientes=$paciente->fetchAll(PDO::FETCH_ASSOC);


foreach($pacientes as $paciente ){
    $rol=$paciente['idRoles'];
}
$n=1;

// Instrucción de recepcion de ID e informacion

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `paciente` WHERE idPaciente=:idPaciente");
    $sentencia->bindParam(":idPaciente",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $dni=$registro["dni"];
    $nombres=$registro['nombres'];
    $sexo=$registro["sexo"];
    $fechaNac=$registro["fechaNac"];
    $direccion=$registro["direccion"];
    $distrito=$registro["distrito"];
    $lugarNac=$registro["lugarNac"];
    $telefono=$registro["telefono"];
    $txt_celular=$registro["celular"];
    $edad=$registro["edad"];
    $hisoriaClinic=$registro["hisoriaClinic"];
    $idUser=$registro["idUser"];

    $sentencia2=$conexion->prepare("SELECT * FROM `eventoscalendar` WHERE idPaciente=:idPaciente");
    $sentencia2->bindParam(":idPaciente",$txtID);
    $sentencia2->execute();
    $registro2=$sentencia2->fetch(PDO::FETCH_LAZY);
    

}

?>

<?php
    if($rol==1){
        include("../../templates/header.php");   
    }else if($rol==2){
        include("../../templates/Doctor/header.php");
    }
?>


<html>  
    <head>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
    <head>  
<body>
<br><br><br>
<div class="container-sm">
<form class="row g-3 needs-validation">

<div class="mb-3">
  <label for="nombres" class="form-label">Nombre del Paciente</label>
  <input type="text" class="form-control" id="nombres" value="<?php echo $nombres?>">
</div>

<div class="mb-3">
  <label for="txt_celular" class="form-label">Celular</label>
  <input type="text" class="form-control" id="txt_celular" value="<?php echo "51".$txt_celular?>">
</div>

<div class="mb-3">
    <label for="txt_documento" class="form-label">Cita a Recordar</label>
    <select id="fecha" name="fecha" class="form-select">
        <option selected>Fecha de Cita</option>
        <?php while ($cita = $sentencia2->fetch(PDO::FETCH_ASSOC)) {
            // Convertir la fecha y hora a formatos deseados
            $fecha_inicio = date('d/m/Y', strtotime($cita['fecha_inicio']));
            $hora_inicio = date('h:i A', strtotime($cita['horainicio']));
        ?>
        <option value="<?php echo $fecha_inicio . ' a las ' . $hora_inicio; ?>">
            <?php echo $fecha_inicio . ' a las ' . $hora_inicio; ?>
        </option>
        <?php } ?>
    </select>
</div>

<div class="col-md-12">
 <input type="button" class="btn btn-primary"  id="btn_notificar" value="Notificar Alerta"/>
</div>

<div class="col-md-12">
<a name="" id="" class="btn btn-secondary" 
href="./index.php" role="button">Regresar</a>
</div>



    </form>
</div>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
	<script type='text/javascript'>
  $(document).ready(function() {
    var token = "GA230610094509";
    var api = "https://script.google.com/macros/s/AKfycbyoBhxuklU5D3LTguTcYAS85klwFINHxxd-FroauC4CmFVvS0ua/exec";
    $("#txt_archivo").change(function() {
      subirFoto("txt_archivo");
    });

    $("#btn_notificar").click(function() {
      // Mostrar SweetAlert de espera
      Swal.fire({
        title: 'Procesando solicitud',
        html: 'Por favor, espere...',
        allowOutsideClick: false,
        onBeforeOpen: () => {
          Swal.showLoading();
        }
      });

      var payload = {
        "op": "registermessage",
        "token_qr": token,
        "mensajes": [{
          "numero": $("#txt_celular").val(),
          "mensaje": "Hola paciente *" + $("#nombres").val() +
            ".* \n" + "Recordarle que usted tiene una cita médica el día " +
            $("#fecha").val() +
            ". \n \n" + "Saludos cordiales por parte del Consultorio San Francisco."
        }]
      };
      $.ajax({
        url: api,
        jsonp: "callback",
        method: 'POST',
        data: JSON.stringify(payload),
        async: false,
        success: function(respuestaSolicitud) {
          Swal.close(); // Cerrar SweetAlert de espera

          // Mostrar SweetAlert con el resultado de la solicitud
          Swal.fire({
            title: 'Solicitud procesada',
            text: 'La solicitud ha sido procesada correctamente.',
            icon: 'success'
          });

          alert(respuestaSolicitud.message);
        }
      });
    });
  });
</script>
    

  </body>
  </html>


  <?php include("../../templates/footer.php");?>