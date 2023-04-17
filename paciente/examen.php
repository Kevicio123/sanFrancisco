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
    WHERE p.idUser =$id");
    $sentencia->execute();
    $lista_pacientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia2=$conexion->prepare("SELECT *
    FROM `tratamiento` t 
    INNER JOIN `examen` e ON e.idTrat = t.idTrat
    INNER JOIN `paciente` p ON p.idPaciente =t.idPaciente
    WHERE p.idUser =$id");
    $sentencia2->execute();
    $lista_examenes=$sentencia2->fetchAll(PDO::FETCH_ASSOC);

    foreach( $lista_examenes as $examen){
        $examen=$examen['tipExamen'];
     }

     $n=0;
     


?>


<?php include("../templates/Paciente/header.php");?>
    <br>
    
    <h2 align="center">Lista de Examenes</h2>


    <br>
    

    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Examen</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Paciente</th>
                        <th scope="col">Tratamiento</th>
                        <th scope="col">Estado</th>
                        <th scope="col"></th>
                        
                        
                        
                    </tr>
                </thead>
                <tfoot >
                <?php foreach($lista_pacientes as $paciente) 
                
                { ?>
            
                
                    <tr class="">
                        <td><?php $n=$n+1; echo $n;?></td>
                        <td><?php echo $examen ?></td>
                        <td><?php echo $paciente['comentarios']; ?></td>
                        <td><?php echo $paciente['nombres']; ?></td>
                        <td><?php echo $paciente['nomTrata']; ?></td>
                        <td><?php if (isset($paciente['examen'])?$paciente['examen']:""){ ?><b><p class="text-success">Enviado</p></b>
                        <?php
                        }else{ ?> 
                           <b><p class="text-danger">Pendiente</p></b>
                          </td> <?php } ?> 
                        <td> <a name="" id="" class="btn btn-primary" 
                        href="edit.php?txtID=<?php echo $paciente['idExamen']; ?>"
                        role="button">Enviar Examen</a>
                        
                        
            
        </td>
                      
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


  





    <?php include("../templates/Paciente/footer.php");?>

    
