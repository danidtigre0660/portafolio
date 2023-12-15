<?php 
include("../../bd.php");


if(isset($_GET['txtID'])){
    //borrar

    $txtID=(isset($_GET['txtID'])) ? $_GET['txtID']:"";
    
    $sentencia=$conexion->prepare("DELETE FROM `tbl_configuraciones` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}





$sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones`");
$sentencia->execute();
$lista_configuraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);


include("../../templates/header.php");

?>


<div class="card">

    <div class="card-header">
        CONFIGURACION
   <!-- <a name="" id="" class="btn btn-success" href="crear.php" role="button">AGREGAR CONFIGURACIONES</a>-->
    </div>

    <div class="card-body">
        <div
            class="table-responsive"
        >
            <table
                class="table table-danger"
            >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de la configuracion</th>
                        <th scope="col">Valor</th>
                       <th scope="col">Acciones</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($lista_configuraciones as $registros) { ?>
                    
                    <tr class="">
                        <td scope="row"><?php echo $registros ['ID'] ;?></td>
                        <td><?php echo $registros ['nombreconfiguracion'] ;?></td>
                        <td><?php echo $registros ['valor'] ;?></td>
                        
                        <td>

                        <a class="btn btn-success"
                        href="editar.php?txtID=<?php echo $registros['ID'];?>"
                        role="button"
                        >EDITAR</a>

                       <!-- <a class="btn btn-danger"
                        href="index.php?txtID=<?php echo $registros['ID'];?>"
                        role="button"
                        >ELIMINAR</a>-->

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