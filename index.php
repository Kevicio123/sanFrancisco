
    <?php include("templates/header.php");?>
    <?php include("./db.php");?>
    <?php include("principal.php");?>
    <?php $url_base="http://localhost/proySanFranciscoPHP/";?>
    <br>
    <br>

    <div class="col-md-12">
        <div class="alert alert-light" role="alert">
        <h2 align="center">Secciones Odontológicas</h2><br>
        <p><b>Bienvenido(a)</b> usuario <?php echo $correoA?> </p>
    </div>
    <hr>

    <div class="row align-items-md-stretch" align="center">

        
        
        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/usuarios/">
            <img class="card-img-top" src="./images/administrador/usuarios.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Usuarios</h4>
            </a>
            </div>
            </div>  
        </div>
        <div class="col-md-3">
            <a href="<?php echo $url_base?>secciones/doctor/">
            <div class="card" style="width: 16rem;">
            <img class="card-img-top" src="./images/administrador/doctores.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Doctores</h4>
            </a>
            </div>
            </div>         
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/paciente/">
            <img class="card-img-top" src="./images/administrador/paciente.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Pacientes</h4>
            </a>
            </div>
            </div>         
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/servicios/">
            <img class="card-img-top" src="./images/administrador/servicios.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Servicios</h4>
            </a>
            </div>
            </div> 
            <br>
            <br>
            <br>        
        </div>
        
        
        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/reportes/">
            <img class="card-img-top" src="./images/administrador/reportes.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Reportes</h4>
            </a>
            </div>
            </div>  
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/tratamiento/">
            <img class="card-img-top" src="./images/administrador/tratamiento.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Tratamientos</h4>
            </a>
            </div>
            </div>         
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/examen/">
            <img class="card-img-top" src="./images/administrador/examenes.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Exámenes Médicos</h4>
            </a>
            </div>
            </div>         
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/historiaClínica/">
            <img class="card-img-top" src="./images/administrador/historiaClinica.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Historia Clínica</h4>
            </div>
            </div>  
            </a> 
            <br>
            <br>
            <br>         
        </div>


        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/especialidades/">
            <img class="card-img-top" src="./images/administrador/doctor.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Especialidades</h4>
            </a>
            </div>
            </div>  
        </div>
        
        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/calendario/index.php">
            <img class="card-img-top" src="./images/administrador/cita.png" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Citas Médicas</h4>
            </a>
            </div>
            </div>         
        </div>

        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/sugerencias/">
            <img class="card-img-top" src="./images/administrador/quejas.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Sugerencias</h4>
            </a>
            </div>
            </div>         
        </div>

        <div class="col-md-3">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>chatbot.php">
            <img class="card-img-top" src="./images/administrador/chatbot.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Chatbot</h4>
            </a>
            </div>
            </div>      
            <br>
            <br>
            <br>   
        </div>

        <div class="col-md-6" align="center">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/repositorio/">
            <img class="card-img-top" src="./images/repositorio.png" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Repositorio de Imágenes</h4>
            </a>
            </div>
            </div>  
        </div>

        <div class="col-md-6" align="center">
            <div class="card" style="width: 16rem;">
            <a href="<?php echo $url_base?>secciones/alertas/">
            <img class="card-img-top" src="./images/ALERTA.jpg" alt="Card image cap">
            <div class="card-body"><br>
            <h4 class="card-text" align="center">Alertas Médicas</h4>
            </a>
            </div>
            </div>  
        </div>

        

    </div>


    <?php include("templates/footer.php");?>

