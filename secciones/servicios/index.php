<?php 
include ("../../db.php");

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `tiposervicio` WHERE idTipSer=:idTipSer");
    $sentencia->bindParam(":idTipSer",$txtID);
    $sentencia->execute();
    header("Location:index.php");

}

// Instrucción de mostrado de Tabla

$sentencia=$conexion->prepare("SELECT * FROM `tiposervicio`");
$sentencia->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$cont=1;

?>
<?php include("../../templates/header.php");?>
    <br>
    <br>

    <h3>Lista de Sevicios Médicos</h3>
    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr>
                        <th align="center">Registro</th>
                        <th scope="col">Servicio Médico</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                <?php foreach($lista_servicios as $servicio)
                    
                    { ?>
                    
                    <tr class="">
                        <td align="center"><?php echo $cont++; ?></td>
                        <td><?php echo $servicio['nomSer']; ?></td>
                        <td><?php echo $servicio['detalle']; ?></td>
                        
                        <td>
                    
                        <a name="" id="" class="btn btn-secondary" 
                         href="edit.php?txtID=<?php echo $servicio['idTipSer']; ?>"
                          role="button">Editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" 
                         href="javascript:borrar(<?php echo $servicio['idTipSer']; ?>);"
                          role="button">Eliminar</a>
 
                    </td>
                    </tr>
                    <?php }  ?>

                </tbody>       
            </table>
            <a name="" id="" class="btn btn-dark" 
            href="create.php" role="button">Agregar Servicio</a>
        </div>
        





<?php include("../../templates/footer.php");?>