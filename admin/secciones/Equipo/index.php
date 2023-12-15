<?php 
include("../../bd.php");


if(isset($_GET['txtID'])){
    //recuperamos los datos del ID

    $txtID=(isset($_GET['txtID'])) ? $_GET['txtID']:"";


    $sentencia=$conexion->prepare("SELECT imagen FROM `tbl_equipo` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
    

    if(isset($registro_imagen["imagen"])){

        if(file_exists("../../../assets/img/team/".$registro_imagen["imagen"])){
            
            unlink("../../../assets/img/team/".$registro_imagen["imagen"]);
            }
        }

$sentencia=$conexion->prepare("DELETE FROM `tbl_equipo` WHERE id=:id");
$sentencia->bindParam(":id",$txtID);
$sentencia->execute();

}


$sentencia=$conexion->prepare("SELECT * FROM `tbl_equipo`");
$sentencia->execute();
$lista_equipo=$sentencia->fetchAll(PDO::FETCH_ASSOC);




include("../../templates/header.php");

?>

<div class="card">

    <div class="card-header">
    <a name="" id="" class="btn btn-success" href="crear.php" role="button">CREAR EQUIPO</a>
    </div>

    <div class="table-responsive">
        <table
            class="table table-success"
        >
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Twitter</th>
                    <th scope="col">Facebook</th>
                    <th scope="col">Linkedin</th>
                    <th scope="col">Acciones</th>

                </tr>
            </thead>
            <tbody>
                
            <?php foreach($lista_equipo as $registros) { ?>
                <tr class="">
                    <td scope="row"><?php echo $registros ['ID'] ;?></td>
                    <td><img  width="80"src="../../../assets/img/team/<?php echo $registros ['imagen'] ;?>"/></td>
                    <td><?php echo $registros ['nombrecompleto'] ;?></td>
                    <td><?php echo $registros ['puesto'] ;?></td>
                    <td><?php echo $registros ['twiter'] ;?></td>
                    <td><?php echo $registros ['facebook'] ;?></td>
                    <td><?php echo $registros ['linkerin'] ;?></td>
                    
                    <td>
                    <a class="btn btn-success"
                        href="editar.php?txtID=<?php echo $registros['ID'];?>"
                        role="button"
                        >EDITAR</a>

                        <a class="btn btn-danger"
                        href="index.php?txtID=<?php echo $registros['ID'];?>"
                        role="button"
                        >ELIMINAR</a>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
    

  
      
    </div>

    <div class="card-footer text-muted"></div>

</div>















<?php include("../../templates/footer.php");

?>