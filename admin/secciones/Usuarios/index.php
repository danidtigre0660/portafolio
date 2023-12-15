<?php 

include ("../../bd.php");


if(isset($_GET['txtID'])){
    //borrar

    $txtID=(isset($_GET['txtID'])) ? $_GET['txtID']:"";
    
    $sentencia=$conexion->prepare("DELETE FROM `tbl_usuarios` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}


$sentencia=$conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);



include("../../templates/header.php");

?>

<div class="card">
    <div class="card-header">

    <a name="" id="" class="btn btn-success" href="crear.php" role="button">CREAR USUARIO</a>

    </div>

    <div class="card-body">
       <div
    class="table-responsive"
>
    <table
        class="table table-primary"
    >
        <thead>
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Correo</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Acciones</th>

        </thead>
        <tbody>
        <?php foreach($lista_usuarios as $registros) { ?>
            <tr class="">
                <td scope="row"><?php echo $registros ['usuario'] ;?></td>
                <td><?php echo $registros ['correo'] ;?></td>
                <td><?php echo $registros ['password'] ;?></td>
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