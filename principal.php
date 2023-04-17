
<?php
if(isset($_SESSION['correo'])){

    $user_session=$_SESSION['correo'];
    $paciente = $conexion->prepare
    ("SELECT *,
    (SELECT nombres FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS paciente,
    (SELECT apaeMat FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS apeMat,
    (SELECT apePat FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS apePat,
    (SELECT sexo FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS sexo,
    (SELECT correo FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS correo,
    (SELECT fechaNac FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS fecha,
    (SELECT direccion FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS direccion,
    (SELECT celular FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS celular,
    (SELECT distrito FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS distrito,
    (SELECT lugarNac FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS lugarNac,
    (SELECT dni FROM paciente 
    WHERE users.IdUser=paciente.IdUser) AS dni
     FROM users 
    WHERE correo = '$user_session'");

    $paciente->execute();
    $pacientes=$paciente->fetchAll(PDO::FETCH_ASSOC);

    foreach( $pacientes as $paciente ){
        $id=$paciente['idUser'];
        $name=$paciente['correo'];
        $nombres=$paciente['paciente'].' '.$paciente['apePat'].' '.$paciente['apeMat'];
        $sexo=$paciente['sexo'];
        $correo=$paciente['correo'];
        $fecha=$paciente['fecha'];
        $direccion=$paciente['direccion'];
        $distrito=$paciente['distrito'];
        $celular=$paciente['celular'];
        $dni=$paciente['dni'];
        $lugarNac=$paciente['lugarNac'];

    }


    $administrador = $conexion->prepare
    ("SELECT correo FROM users WHERE correo = '$user_session'");
    $administrador->execute();
    $administradores=$administrador->fetchAll(PDO::FETCH_ASSOC);

    foreach( $administradores as $administrador ){
        $correoA=$administrador['correo'];
    }


}





?>
