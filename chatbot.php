<?php 
session_start();
include ("./db.php");
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
        include("./templates/header.php");   
    }else if($rol==2){
        include("./templates/Doctor/header.php");
    }else if($rol==3){
        include("./templates/Paciente/header.php");
    }
?>

<?php include("./principal.php");?>




<div class="ourwork">
          <div class="container">
             <div class="row">
                <div class="col-md-12">
                   <div class="titlepage">
                   <h1 style="font-size: 25px; line-height: 20px; text-transform: uppercase;font-weight: 900;"></h1>
                   </div>
                   <p></p>
                </div>
             </div>
             <div class="row text-center justify-content-center">
             <div class="col-md-12">
                   <div class="our_box">
                   <iframe src="https://web.powerva.microsoft.com/environments/Default-98201fef-d9f6-4e68-84f5-c2705074e342/bots/new_bot_e5c916a7b0d44db595634ad56a990379/webchat" frameborder="0" style="width: 60%; height: 550px;"></iframe>           
                   </div>
                </div>
             </div>
          </div>
       </div>
      <!--  footer -->
      <footer>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        
                  </div>
               </div>
            </div>
         </div>

   <?php include("./templates/footer.php");?>

        