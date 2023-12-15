<?php

include ("../../bd.php");

if(isset($_GET['txtID'])){
    //recuperamos los datos del ID

    $txtID=(isset($_GET['txtID'])) ? $_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_equipo` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);


    $imagen=$registro['imagen'];
    $nombrecompleto=$registro['nombrecompleto'];
    $puesto=$registro['puesto'];
    
    $twiter=$registro['twiter'];
    $facebook=$registro['facebook'];
    $linkerin=$registro['linkerin'];
    
}

if($_POST){//insertamos los cambios 
    

    $txtID=(isset($_POST['txtID'])) ? $_POST['txtID']:"";
    
    $nombrecompleto=(isset($_POST['nombrecompleto'])) ? $_POST['nombrecompleto']:"";
    $puesto=(isset($_POST['puesto'])) ? $_POST['puesto']:"";
    $twiter=(isset($_POST['twiter'])) ? $_POST['twiter']:"";
    $facebook=(isset($_POST['facebook'])) ? $_POST['facebook']:"";
    $linkerin=(isset($_POST['linkerin'])) ? $_POST['linkerin']:"";
   


    $sentencia=$conexion->prepare("UPDATE `tbl_equipo` SET nombrecompleto=:nombrecompleto,puesto=:puesto,
    twiter=:twiter,facebook=:facebook,linkerin=:linkerin WHERE id=:id");

   
    $sentencia->bindParam(":nombrecompleto",$nombrecompleto);
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":twiter",$twiter);
    $sentencia->bindParam(":facebook",$facebook);
    $sentencia->bindParam(":linkerin",$linkerin);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    if($_FILES["imagen"]["tmp_name"]!=""){

        $imagen=(isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name']:"";
        $fecha_imagen=new DateTime();
        $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";
    
        $tmp_imagen=$_FILES["imagen"]["tmp_name"];
        if($tmp_imagen!=""){
            move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
        }
    
       //borrado de la imagen cuando se cambia
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

            $sentencia=$conexion->prepare("UPDATE `tbl_equipo` SET imagen=:imagen
            WHERE id=:id");
        
            $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();

}
$mensaje="¡¡personal actualizado con exito!!";

header("location:index.php?mensaje=".$mensaje);
}
include("../../templates/header.php");

?>


<div class="card">

    <div class="card-header">
       EDITAR EQUIPO
    </div>

    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="txtID" class="form-label">ID</label>
        <input value="<?php echo $txtID ;?>"
            type="text"
            class="form-control"
            name="txtID"
            id="txtID"
            aria-describedby="helpId"
            placeholder="identificacion"
        />
        
    </div>

    <div class="mb-3">
        <label for="imagen" class="form-label">IMAGEN</label>
        <img  width="80"src="../../../assets/img/team/<?php echo $imagen ;?>"/>
        <input
            type="file"
            class="form-control"
            name="imagen"
            id="imagen"
            aria-describedby="helpId"
            placeholder="imagen"
        />
        
    </div>

    <div class="mb-3">
        <label for="nombrecompleto" class="form-label">NOMBRE COMPLETO</label>
        <input value="<?php echo $nombrecompleto;?>"
            type="text"
            class="form-control"
            name="nombrecompleto"
            id="nombrecompleto"
            aria-describedby="helpId"
            placeholder="nombre completo"
        />
        
    </div>

    <div class="mb-3">
        <label for="puesto" class="form-label">PUESTO</label>
        <input

            value="<?php echo $puesto;?>"
            type="text"
            class="form-control"
            name="puesto"
            id="puesto"
            aria-describedby="helpId"
            placeholder="puesto"
        />
        
    </div>

    <div class="mb-3">
        <label for="twiter" class="form-label">TWITTER</label>
        <input value="<?php echo $twiter ;?>"
            type="text"
            class="form-control"
            name="twiter"
            id="twiter"
            aria-describedby="helpId"
            placeholder="twitter"
        />
        
    </div>

    <div class="mb-3">
        <label for="facebook" class="form-label">FACEBOOK</label>
        <input
             value="<?php echo $facebook ;?>"
            type="text"
            class="form-control"
            name="facebook"
            id="facebook"
            aria-describedby="helpId"
            placeholder="facebook"
        />
        
    </div>

    <div class="mb-3">
        <label for="linkerin" class="form-label">LINKEDIN</label>
        <input value="<?php echo $linkerin;?>"
            type="text"
            class="form-control"
            name="linkerin"
            id="linkerin"
            aria-describedby="helpId"
            placeholder="linkedin"
        />
        
    </div>

        <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">CANCELAR</a>
    


    </form>


      
    </div>

    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php");

?>