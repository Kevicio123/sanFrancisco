<?php

include("../db.php");
    session_start();
    
    $user_session=$_SESSION['correo'];
    $paciente = $conexion->prepare
    ("SELECT *,
    (SELECT idUser FROM paciente WHERE users.IdUser=paciente.IdUser) AS id
     FROM users WHERE correo = '$user_session'");
     $paciente->execute();
     $pacientes=$paciente->fetchAll(PDO::FETCH_ASSOC);
    
     foreach( $pacientes as $paciente){
        $id=$paciente['id'];
     }

    $sentencia=$conexion->prepare("SELECT *
    FROM `examen` e 
    INNER JOIN `paciente` p ON e.idPaciente =p.idPaciente
    INNER JOIN `tratamiento` t ON e.idTrat = t.idTrat
    WHERE p.idUser ='$id'");
    $sentencia->execute();
    $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia2=$conexion->prepare("SELECT *
    FROM `tratamiento` t 
    INNER JOIN `examen` e ON e.idTrat = t.idTrat
    INNER JOIN `paciente` p ON p.idPaciente =t.idPaciente
    WHERE p.idUser ='$id'");
    $sentencia2->execute();
    $lista_examenes=$sentencia2->fetchAll(PDO::FETCH_ASSOC);

    foreach( $lista_examenes as $examen){
        $examen=$examen['tipExamen'];
     }

     $n=-1;
     


?>


<?php include("../templates/Paciente/header.php");?>
    <br>
    
    <h2 align="center">Lista de Examenes</h2>

    

    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table" id="tabla">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">N° Ordenar</th>
                        
                        
                        
                    </tr>
                </thead>
                <tfoot >
                <?php foreach($lista_pacientes as $paciente) 
                
                { ?>
                    <tr class="">
                        <td>
                    
                        <div class="card">
                        <div class="card-header">
                           
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"> <?php $n=$n+1; echo $n.'. ';?>Examen de <?php echo $paciente['tipExamen'] ?></h5>
                            <p class="card-text"><?php echo $paciente['Comentarios']; ?></p>
                            <?php if (isset($paciente['examen'])?$paciente['examen']:""){ ?> <b> <p class="text-success">Enviado</p></b>
                            <?php
                            }else{ ?> 
                            <b><p class="text-danger">Pendiente</p></b>
                            <?php } ?> 
                            <a name="" id="" class="btn btn-primary" 
                            href="edit.php?txtID=<?php echo $paciente['idExamen']; ?>" role="button">Enviar Examen</a>
                            
                        </div>
                        </div>
                        <br>
                        </td>
                    
                    </tr>
                    
                  
                </tfoot>
                
                <?php }?>
                
            </table>
            <a href="tratamiento.php" class="btn btn-success">Regresar</a>

           
            
        </div>
         


        </div>

        
    </div>

 

    <br>


  





    <?php include("../templates/footer.php");?>

    
