<?php include("templates/Doctor/header.php");?>
    <?php include("./db.php");?>
    <?php include("principal2.php");?>
    <br>
    <br>

    

    <div class="col-md-12">
        <h2 align="center">Secciones Odontológicas</h2><br>
        <div class="alert alert-light" role="alert">
        <p><b>Si tiene dudas</b> sobre el uso de la plataforma, seleccione<a href="./doctor/manual.php"> Aquí.</a></p>
    </div>

<div class="row align-items-md-stretch" align="center">

        
    <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/tratamiento/index.php">
            <img class="card-img-top" src="./images/administrador/tratamiento.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Tratamientos</h4>
            </a>
            </div>
            </div>         
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>doctor/listaExamenes.php">
            <img class="card-img-top" src="./images/administrador/examenes.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Exámenes Médicos</h4>
            </a>
            </div>
            </div>         
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/historiaClínica/">
            <img class="card-img-top" src="./images/administrador/historiaClinica.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Historia Clínica</h4>
            </a>
            </div>
            </div> 
            <br>
            <br>
            <br>         
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/calendario/index.php">
            <img class="card-img-top" src="./images/administrador/cita.png" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Citas Médicas</h4>
            </a>
            </div>
            </div>         
        </div>


        <div class="col-md-4" align="center">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/repositorio/">
            <img class="card-img-top" src="./images/repositorio.png" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Repositorio de Imágenes</h4>
            </a>
            </div>
            </div>  
        </div>
        

        <div class="col-md-4" align="center">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/alertas/">
            <img class="card-img-top" src="./images/ALERTA.jpg" alt="Card image cap">
            <div class="card-body"><br>
            <h4 class="card-text" align="center">Alertas Médicas</h4>
            </a>
            </div>
            </div>  
        </div>

        <div class="col-md-6" align="center"><br><br>
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/reportes/">
            <img class="card-img-top" src="./images/administrador/reportes.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Reportes</h4>
            </a>
            </div>
            </div> 
        <br>
        <br> 
        </div>

        <div class="col-md-6" align="center"><br><br>
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>chatbot.php">
            <img class="card-img-top" src="./images/administrador/chatbot.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Chatbot</h4>
            </a>
            </div>
            </div>      
        
        </div>
        

        

</div>


    <?php include("templates/footer.php");?>
