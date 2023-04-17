<?php 
include ("../../db.php");

// Instrucción de borrado

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM `users` WHERE idUser=:idUser");
    $sentencia->bindParam(":idUser",$txtID);
    $sentencia->execute();
    header("Location:index.php");


}

// Instrucción de mostrado de Tabla

$sentencia=$conexion->prepare("SELECT *,
(SELECT n_Rol FROM rol 
WHERE rol.idRoles=users.idRoles limit 1) as rol,
(SELECT nombres FROM paciente
WHERE paciente.idUser=users.idUser limit 1) as paciente,
(SELECT nombres FROM doctor 
WHERE doctor.idUser=users.idUser limit 1) as doctor
FROM `users`");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);





?>
<?php include("../../templates/header.php");?>
    <br>
    <br>
    <h3>Lista de Usuarios</h3>
    <br>
    <div class="card">
        
        <div class="card-body">
        
        <div class="table-responsive-sm">
            
            <table class="table table-striped table-hover" id="tabla">
                <thead>
                    <tr align="center">
                        <th scope="col">Correo</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Persona</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                        
                    </tr>
                </thead>
                <tfoot align="center">
                <?php foreach($lista_usuarios as $usuario) 
                
                {?>
                
                    <tr>

                        <td><?php echo $usuario['correo']; ?></td>
                        <td> ***** </td>
                        <td> <?php if (isset($usuario['paciente'])?$usuario['paciente']:""){ echo $usuario['paciente'];} 
                        elseif(isset($usuario['doctor'])?$usuario['doctor']:""){
                            echo $usuario['doctor'];
                        }else{
                            echo "No existen Datos";}?> </td>
                        <td><?php echo $usuario['rol']; ?></td>
                        
                        <td>
                        <a name="" id="" class="btn btn-secondary" 
                         href="edit.php?txtID=<?php echo $usuario['idUser']; ?>"
                         role="button">Editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" 
                         href="javascript:borrar(<?php echo $usuario['idUser']; ?>);"
                         role="button">Eliminar</a>
                        
                        
                    </td>
                    </tr>
                </tfoot>

                <?php    
                }?>
                
            </table>
            <a name="" id="" class="btn btn-dark" 
            href="create.php" role="button">Agregar Usuario</a>
        </div>
        </div>
        </div>
        
        


<?php include("../../templates/footer.php");?>