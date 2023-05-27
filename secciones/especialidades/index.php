<?php 
include ("../../db.php");

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `especialidad` WHERE idEsp=:idEsp");
    $sentencia->bindParam(":idEsp",$txtID);
    $sentencia->execute();
    header("Location:index.php");

}

// Instrucción de mostrado de Tabla

$sentencia=$conexion->prepare("SELECT * FROM `especialidad`");
$sentencia->execute();
$lista_especialidades=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$n=1;

?>

<?php include("../../templates/header.php");?>

    <br>
    <br>
    <h3>Lista de Especialidades Médicas</h3>
    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr align="center">
                        <th scope="col" align="center">Registro</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                <?php foreach($lista_especialidades as $especialidad) 
                
                {?>
                    <tr class="">
                        <td align="center"><?php  echo $n++;?> </td>
                        <td><?php echo $especialidad['especialidad']; ?></td>
                        <td><?php echo $especialidad['detalle']; ?></td>
                        
                        <td>
                        <a name="" id="" class="btn btn-secondary" 
                        href="edit.php?txtID=<?php echo $especialidad['idEsp']; ?>"
                        role="button">Editar</a>
                        
                        |
                        <a name="" id="" class="btn btn-danger" 
                         href="javascript:borrar(<?php echo $especialidad['idEsp']; ?>);"
                         role="button">Eliminar</a>
                        
                        
                    </td>
                    </tr>
                <?php } ?> 
                </tbody>
                  
                
            </table>
            <a name="" id="" class="btn btn-dark" 
            href="create.php" role="button">Agregar Especialidad</a>
        </div>
        
        <script>
        function borrar(id){
        
        Swal.fire({
        title: '¿Desea borrar la especialidad?',
        showCancelButton: true,
        confirmButtonText: 'Sí, Borrar',
        }).then((result) => {
  
        if (result.isConfirmed) {
        window.location="index.php?txtID="+id;
        Swal.fire('Eliminado satisfactoriamente!', '', 'success')
        } 
        })  
        }

        </script>





<?php include("../../templates/footer.php"); ?>