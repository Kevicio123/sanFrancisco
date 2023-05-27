<?php 
include ("../../db.php");
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

    if($rol==1){
      include("../../templates/header2.php");   
    }else if($rol==2){
      include("../../templates/doctor/header2.php");
    }
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Control de Citas</title>
	<link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  
</head>
<body>

<?php
include('./config.php');


  if($rol==1){
  $SqlEventos2   = ("SELECT * FROM eventoscalendar");
  $resulEventos = mysqli_query($con, $SqlEventos2);
  

  }else if($rol==2){

  if(isset($_SESSION['correo'])) {
    $user_session = $_SESSION['correo'];
    
    // consulta para obtener el id del usuario
    $stmt = $conexion->prepare("SELECT idUser FROM users WHERE correo = ?");
    $stmt->execute([$user_session]);
    $row = $stmt->fetch();
    $idUser = $row['idUser'];

    $stmt = $conexion->prepare("SELECT idDoctor FROM doctor WHERE idUser = ?");
    $stmt->execute([$idUser]);
    $row = $stmt->fetch();
    $idDoctor = $row['idDoctor'];

    // consulta para obtener los eventos del doctor logueado
    $stmt = $conexion->prepare("SELECT * FROM eventoscalendar WHERE idDoctor = ?");
    $stmt->execute([$idDoctor]);
    $resulEventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  }
}

?>
<div class="mt-5"></div>

<div class="container">
  <div class="row">
    <div class="col msjs">
      <?php
        include('msjs.php');
      ?>
    </div>
  </div>

<div class="row">
  <div class="col-md-12 mb-3">
  <h3 class="text-center" id="title">Calendario de Citas Médicas</h3>
  </div>

</div>





<div id="calendar"></div>


<?php  
  include('modalNuevoEvento.php');
  include('modalUpdateEvento.php');
?>


<div>
  <br><br>
  
  <div class="row">  

  <div class="col-md-8">

  <h3>Leyenda de Colores</h3>
  <br>

  </div>

  <div class="col-md-4" align="center">

    <a href="../atenciones/index.php" type="button" class="btn btn-primary">Ver Lista de Atenciones</a>

  </div>
    <br>


  <div class="col-md-1">
  <input type="radio" name="color_evento" id="amber" value="#FFC107">  
  <label for="amber" class="circu" style="background-color: #FFC107;"></label>  

  <input type="radio" name="color_evento" id="teal" value="#009688">  
  <label for="teal" class="circu" style="background-color: #009688;"> </label>  <br>

  <input type="radio" name="color_evento" id="indigo" value="#DF4268">  
  <label for="indigo" class="circu" style="background-color: #DF4268;"> </label>

  </div>

  <div class="col-md-4" align="left">
  <label for="">Cita Virtual</label> <br> <br>

  <label for="">Cita Presencial</label> <br> <br>

  <label for="">Cita Cancelada</label>
  </div>
    

  </div> 



</div>
<script src ="js/jquery-3.0.0.min.js"> </script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/moment.min.js"></script>	
<script type="text/javascript" src="js/fullcalendar.min.js"></script>
<script src='locales/es.js'></script>
</div>
<br>

<script type="text/javascript">
$(document).ready(function() {
  $("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay"
    },

    locale: 'es',

    defaultView: "month",
    navLinks: true, 
    editable: true,
    eventLimit: true, 
    selectable: true,
    selectHelper: false,

//Nuevo Evento
  select: function(start, end){
      $("#exampleModal").modal();
      $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));
       
      var valorFechaFin = end.format("DD-MM-YYYY");
      var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); //Le resto 1 dia
      $('input[name=fecha_fin').val(F_final);  
    },
      
    events: [
      <?php
       foreach($resulEventos as $dataEvento){ ?>
          {
          _id: '<?php echo $dataEvento['id']; ?>',
          title: '<?php echo $dataEvento['evento']; ?>',
          start: '<?php echo $dataEvento['fecha_inicio']; ?>',
          end:   '<?php echo $dataEvento['fecha_fin']; ?>',
          horainicio: '<?php echo $dataEvento['horainicio']; ?>',
          modalidad: '<?php echo $dataEvento['modalidad']; ?>',
          estado: '<?php echo $dataEvento['estado']; ?>',
          idDoctor: '<?php echo $dataEvento['idDoctor']; ?>',
          idPaciente: '<?php echo $dataEvento['idPaciente']; ?>',
          color: '<?php echo $dataEvento['color_evento']; ?>'
          },
        <?php } ?>
    ],


//Eliminar Evento
eventRender: function(event, element) {
    element
      .find(".fc-content")
      .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");
    
    //Eliminar evento
    element.find(".closeon").on("click", function() {

  var pregunta = confirm("Deseas Borrar este Evento?");   
  if (pregunta) {

    $("#calendar").fullCalendar("removeEvents", event._id);

     $.ajax({
            type: "POST",
            url: 'deleteEvento.php',
            data: {id:event._id},
            success: function(datos)
            {
              $(".alert-danger").show();

              setTimeout(function () {
                $(".alert-danger").slideUp(500);
              }, 3000); 

            }
        });
      }
    });
  },


//Moviendo Evento Drag - Drop
eventDrop: function (event, delta) {
  var idEvento = event._id;
  var start = (event.start.format('DD-MM-YYYY'));
  var end = (event.end.format("DD-MM-YYYY"));
  var hora = (event.hora.format("hh:mm:ss A"));

    $.ajax({
        url: 'drag_drop_evento.php',
        data: 'start=' + start + '&end=' + end + '&hora=' +hora+ '&idEvento=' + idEvento,
        type: "POST",
        success: function (response) {
         // $("#respuesta").html(response);
        }
    });
},

//Modificar Evento del Calendario 
eventClick:function(event){
    var idEvento = event._id;
    $('input[name=idEvento]').val(idEvento);
    $('input[name=evento]').val(event.title);
    $('input[name=fecha_inicio]').val(event.start.format('DD-MM-YYYY'));
    $('input[name=horainicio]').val(event.horainicio);
    $('input[name=fecha_fin]').val(event.end.format("DD-MM-YYYY"));
    $('input[name=modalidad]').val(event.modalidad);
    $('select[name=estado').val(event.estado);
    $("#modalUpdateEvento").modal();
  },


  });


//Oculta mensajes de Notificacion
  setTimeout(function () {
    $(".alert").slideUp(300);
  }, 3000); 


});

</script>

<!--------- WEB DEVELOPER ------>
<!--------- URIAN VIERA   ----------->
<!--------- PORTAFOLIO:  https://blogangular-c7858.web.app  -------->

</body>
</html>

