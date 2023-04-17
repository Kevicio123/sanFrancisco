<?php
if(isset($_SESSION['correo'])){

    $user_session=$_SESSION['correo'];
    $doctor = $conexion->prepare
    ("SELECT *,
    (SELECT nombres FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS nombres,
    (SELECT apaeMat FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS apeMat,
    (SELECT apePat FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS apePat,
    (SELECT sexo FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS sexo,
    (SELECT correo FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS correo,
    (SELECT fechaNac FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS fecha,
    (SELECT direccion FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS direccion,
    (SELECT celular FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS celular,
    (SELECT distrito FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS distrito,
    (SELECT dni FROM doctor 
    WHERE users.IdUser=doctor.IdUser) AS dni
     FROM users 
    WHERE correo = '$user_session'");

    $doctor->execute();
    $doctores=$doctor->fetchAll(PDO::FETCH_ASSOC);

    foreach( $doctores as $doctor ){
        $id=$doctor['idUser'];
        $name=$doctor['correo'];
        $nombres=$doctor['nombres'].' '.$doctor['apePat'].' '.$doctor['apeMat'];
        $sexo=$doctor['sexo'];
        $correo=$doctor['correo'];
        $fecha=$doctor['fecha'];
        $direccion=$doctor['direccion'];
        $distrito=$doctor['distrito'];
        $celular=$doctor['celular'];
        $dni=$doctor['dni'];

    }
}

?>