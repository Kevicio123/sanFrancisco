
<?php include("templates/Doctor/header.php");?>
    <?php include("./db.php");?>
    <?php include("principal2.php");?>
    <br>
    <br>

    

    <div class="col-md-12">
        <div class="alert alert-light" role="alert">
        <p><b>Bienvenido</b> doctor(a) <?php echo $nombres?> </p>
    </div>
    <hr>

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
            <a href="<?php echo $url_base?>secciones/atenciones/">
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

        <div class="col-md-4">
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

        <div class="col-md-12" align="center">
            <div class="card" style="width: 16rem;">
            <img class="card-img-top" src="./images/administrador/chatbot.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Chatbot</h4>
            </div>
            </div>      
        
        </div>
        

        

</div>


    <?php include("templates/footer.php");?>
