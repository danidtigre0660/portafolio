<?php 

include("../../bd.php");

if($_POST){
    
    $imagen=(isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name']:"";
    $nombrecompleto=(isset($_POST['nombrecompleto'])) ? $_POST['nombrecompleto']:"";
    $puesto=(isset($_POST['puesto'])) ? $_POST['puesto']:"";
    $twiter=(isset($_POST['twiter'])) ? $_POST['twiter']:"";
    $facebook=(isset($_POST['facebook'])) ? $_POST['facebook']:"";
    $linkerin=(isset($_POST['linkerin'])) ? $_POST['linkerin']:"";


    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";
    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
    }

    $sentencia=$conexion->prepare("INSERT INTO `tbl_equipo` (`ID`,`imagen`,
     `nombrecompleto`,`puesto`, `twiter`, `facebook`,`linkerin`)
      VALUES (NULL,:imagen,:nombrecompleto,:puesto,:twiter,:facebook,:linkerin);");


    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":nombrecompleto",$nombrecompleto);
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":twiter",$twiter);
    $sentencia->bindParam(":facebook",$facebook);
    $sentencia->bindParam(":linkerin",$linkerin);
    $sentencia->execute();
 


    $mensaje="¡¡personal agregado con exito!!";

    header("location:index.php?mensaje=".$mensaje);


}

include("../../templates/header.php");

?>

<div class="card">

    <div class="card-header">
      EQUIPO DE TRABAJO
    </div>

    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="txtID" class="form-label">ID</label>
        <input
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
        <input
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
        <input
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
        <input
            type="text"
            class="form-control"
            name="linkerin"
            id="linkerin"
            aria-describedby="helpId"
            placeholder="linkedin"
        />
        
    </div>

        <button type="submit" class="btn btn-primary">AGREGAR AL EQUIPO</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">CANCELAR</a>
    


    </form>


      
    </div>

    <div class="card-footer text-muted"></div>
</div>









<?php include("../../templates/footer.php");

?>