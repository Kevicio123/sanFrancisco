<?php
include("./config.php");

if($_POST){
$numero=(isset($_POST["numero"])?$_POST["numero"]:"");

//TOKEN QUE NOS DA FACEBOOK
$token = 'EAAQuIMuWzTYBAJQ0nH35YqcZAJJ4FZBB5T6rRi3Gq2fKFzWh9lbTn5qCBzi74ZAt5NGvNYX0HAa64iZBOZClZCGNFxcy1JTFIqJV1hyZAZCGqq0HZBuFSumFyYFlqxWqDMiKVjcopSkXwQxjlKO9W2axulzClch6Rdw4AtmeTHp0AKntBq2wklsabeVnD36SOlCZAt87ZBYYDIhSAZDZD';
//NUESTRO TELEFONO
$telefono ='51937643889';
//URL A DONDE SE MANDARA EL MENSAJE
$url = 'https://graph.facebook.com/v17.0/126733600325397/messages';

//CONFIGURACION DEL MENSAJE
$mensaje = ''
        . '{'
        . '"messaging_product": "whatsapp", '
        . '"to": "'.$telefono.'", '
        . '"type": "template", '
        . '"template": '
        . '{'
        . '     "name": "hello_world",'
        . '     "language":{ "code": "en_US" } '
        . '} '
        . '}';
//DECLARAMOS LAS CABECERAS
$header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
//INICIAMOS EL CURL

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
$response = json_decode(curl_exec($curl), true);
//IMPRIMIMOS LA RESPUESTA 
print_r($response);
//OBTENEMOS EL CODIGO DE LA RESPUESTA
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//CERRAMOS EL CURL
curl_close($curl);


}
?>

<form action="" method="post" class="row g-3" enctype="multipart/form-data">

<h3>Datos del Paciente</h3>

<div class="col-md-6">
<label for="numero" class="form-label">Celular</label>
<input type="number" class="form-control" id="numero" name="numero">
</div>

<div class="col-12">
<button type="submit" class="btn btn-primary">Enviar Recordatorio</button>
</div>


</form>





