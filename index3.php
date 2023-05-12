

<?php include("templates/Paciente/header.php");?>
    <?php include("./db.php");?>
    <?php include("principal.php");?>
    <br>
    <br>

    <div class="col-md-12">
        <div class="alert alert-light" role="alert">
        <p><b>Bienvenido</b> paciente <?php echo $nombres?> </p>
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
            <img class="card-img-top" src="./images/administrador/chatbot.jpg" alt="Card image cap">
            <div class="card-body">
            <h4 class="card-text" align="center">Chatbot</h4>
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

        <script>
  window.watsonAssistantChatOptions = {
    integrationID: "6b652c54-cb9f-44e6-bc00-21e266a1b01e", // The ID of this integration.
    region: "us-east", // The region your integration is hosted in.
    serviceInstanceID: "c2859fd9-832d-419f-9bf2-7e6046b9dac1", // The ID of your service instance.
    onLoad: function(instance) { instance.render(); }
  };
  setTimeout(function(){
    const t=document.createElement('script');
    t.src="https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
    document.head.appendChild(t);
  });
</script>
    
    </div>

    
                


    <?php include("templates/Paciente/footer.php");?>
