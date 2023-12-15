<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    //recuperamos los datos del ID

    $txtID=(isset($_GET['txtID'])) ? $_GET['txtID']:"";


    $sentencia=$conexion->prepare("SELECT imagen FROM `tbl_portafolio` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
    

    if(isset($registro_imagen["imagen"])){

        if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
            
            unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
            }
        }

$sentencia=$conexion->prepare("DELETE FROM `tbl_portafolio` WHERE id=:id");
$sentencia->bindParam(":id",$txtID);
$sentencia->execute();

}



$sentencia=$conexion->prepare("SELECT * FROM `tbl_portafolio`");
$sentencia->execute();
$lista_portafolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");

?>
<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-success" href="crear.php" role="button">CREAR PORTAFOLIO</a>
    </div>

    <div class="card-body">
        <div
            class="table-responsive"
        >
            <table
                class="table table-success"
            >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Subtitulo</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Url</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($lista_portafolio as $registros) { ?>

                    <tr class="">
                        <td scope="row"><?php echo $registros ['ID'] ;?></td>
                        <td><?php echo $registros ['titulo'] ;?></td>
                        <td><?php echo $registros ['subtitulo'] ;?></td>

                        <td>
                         <img  width="80"src="../../../assets/img/portfolio/<?php echo $registros ['imagen'] ;?>"/>
                        </td>

                        <td><?php echo $registros ['descripcion'] ;?></td>
                        <td><?php echo $registros ['cliente'] ;?></td>
                        <td><?php echo $registros ['categoria'] ;?></td>
                        <td><?php echo $registros ['url'] ;?></td>
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