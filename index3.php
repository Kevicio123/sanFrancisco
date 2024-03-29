<?php include("templates/Paciente/header.php");?>
    <?php include("./db.php");?>
    <?php include("principal.php");?>
    <br>
    


    <div class="col-md-12">
    <BR>
    <h2 align="center">Secciones Odontológicas</h2>
        <div class="alert alert-light" role="alert"> 
        <p><b>Si tiene dudas</b> sobre el uso de la plataforma, seleccione<a href="./paciente/manual.php"> Aquí.</a></p>
        
    </div>
    <hr>
   
    <div class="row align-items-md-stretch" align="center">
        <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>paciente/tratamiento.php">
            <img class="card-img-top" src="./images/administrador/tratamiento.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Tratamientos</h4>
            </a>
            </div>
            </div>         
        </div>
    

        <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>paciente/examen.php">
            <img class="card-img-top" src="./images/administrador/examenes.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Envio de Exámenes Médicos</h4>
            </a>
            </div>
            </div>         
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>paciente/atenciones.php">
            <img class="card-img-top" src="./images/administrador/cita.png" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Citas Médicas</h4>
            </a>
            </div>
            </div>
            <br><br><br>         
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>paciente/createSugerencia.php">
            <img class="card-img-top" src="./images/administrador/quejas.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Portal de Sugerencias</h4>
            </a>
            </div>
            </div>         
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>chatbot.php">
            <img class="card-img-top" src="./images/administrador/chatbot.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Chatbot</h4>
            </a>
            </div>
            </div>      
             
        </div>

        <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>paciente/preguntasFrecuentes.php">
            <img class="card-img-top" src="./images/administrador/preguntas.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Preguntas Frecuentes</h4>
            </a>
            </div>
            </div>         
    </div>
    
    </div>

    
                


    <?php include("templates/Paciente/footer.php");?>
