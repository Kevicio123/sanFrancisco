<?php 
include ("../../db.php");

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `sugerencias` WHERE idSug=:idSug");
    $sentencia->bindParam(":idSug",$txtID);
    $sentencia->execute();
    header("Location:index.php");


}

// Instrucción de mostrado de Tabla

$sentencia=$conexion->prepare("SELECT *
FROM `sugerencias`");
$sentencia->execute();
$sugerencias=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$n=0;



?>
<?php include("../../templates/header.php");?>
    <br>
    <br>
    <h3>Lista de Sugerencias</h3>
    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr align="center">
                        <th scope="col">Registro</th>
                        <th scope="col">Asunto</th>
                        <th scope="col">Detalle de Sugerencia</th>
                        <th scope="col">Acción</th>
                        
                    </tr>
                </thead>
                <tfoot align="center">
                <?php foreach($sugerencias as $sugerencia) 
                
                {?>
                
                    <tr>
                        <td align="center"><?php  echo $n++;?> </td>
                        <td><?php echo $sugerencia['asunto']; ?></td>
                        <td><?php echo $sugerencia['detalle']; ?></td>
                        
                        <td>
                        <a name="" id="" class="btn btn-danger" 
                         href="javascript:borrar4(<?php echo $sugerencia['idSug']; ?>);"
                         role="button">Eliminar</a>
                        
                        
                    </td>
                    </tr>
                </tfoot>

                <?php    
                }?>
                
            </table>
            <a name="" id="" class="btn btn-dark" 
            href="../../index.php" role="button">Regresar Inicio</a>
        </div>
        


<?php include("../../templates/footer.php");?>