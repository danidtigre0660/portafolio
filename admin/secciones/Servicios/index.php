<?php 

include("../../bd.php");

if(isset($_GET['txtID'])){
    //borrar

    $txtID=(isset($_GET['txtID'])) ? $_GET['txtID']:"";
    
    $sentencia=$conexion->prepare("DELETE FROM `tbl_servicios` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//print_r($lista_servicios);







include("../../templates/header.php");

?>

<div class="card">

    <div class="card-header">
    <a name="" id="" class="btn btn-success" href="crear.php" role="button">AGREGAR REGISTRO</a>
    </div>

    <div class="card-body">

    <div class="table-responsive">
        <table class="table table-primary">
            
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ICONOS</th>
                    <th scope="col">TITULOS</th>
                    <th scope="col">DESCRIPCIONES</th>
                    <th scope="col">ACCIONES</th>
                    
                </tr>
            </thead>

            <tbody>

            <?php foreach($lista_servicios as $registros) { ?>

                <tr class="">
                    <td scope="row"><?php echo $registros ['ID'] ;?></td>
                    <td><?php echo $registros ['icono'] ;?></td>
                    <td><?php echo $registros ['titulo'] ;?></td>
                    <td><?php echo $registros ['descripcion'] ;?></td>
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


    <div class="card-footer text-muted">
    </div>

</div>

<?php include("../../templates/footer.php");

?>