<?php

include ("../../bd.php");

if($_POST){
    

    $titulo=(isset($_POST['titulo'])) ? $_POST['titulo']:"";
    $subtitulo=(isset($_POST['subtitulo'])) ? $_POST['subtitulo']:"";
    $imagen=(isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name']:"";
    $descripcion=($_POST['descripcion']) ? $_POST['descripcion']:"";
    $cliente=($_POST['cliente']) ? $_POST['cliente']:"";
    $categoria=($_POST['categoria']) ? $_POST['categoria']:"";
    $url=($_POST['url']) ? $_POST['url']:"";

    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";
    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../../../assets/img/portfolio/".$nombre_archivo_imagen);
    }




    $sentencia=$conexion->prepare("INSERT INTO `tbl_portafolio` (`ID`, `titulo`, `subtitulo`, `imagen`,
     `descripcion`,`cliente`, `categoria`, `url`)
      VALUES (NULL,:titulo,:subtitulo,:imagen,:descripcion,:cliente,:categoria,:url);");

    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":subtitulo",$subtitulo);
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":cliente",$cliente);
    $sentencia->bindParam(":categoria",$categoria);
    $sentencia->bindParam(":url",$url);


    $sentencia->execute();

    
    $mensaje="¡¡portafolio creado  con exito!!";

    header("location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php");

?>

<div class="card">

    <div class="card-header">
        PRODUCTO DEL PORTAFOLIO
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

     <div class="mb-3">
        <label for="txtID" class="form-label">ID</label>
        <input type="text"
            class="form-control"
            name="txtID"
            id="txtID"
            aria-describedby="helpId"
            placeholder="Identificacion"
        />
       </div>

       <div class="mb-3">
        <label for="titulo" class="form-label">TITULO</label>
        <input
            type="text"
            class="form-control"
            name="titulo"
            id="titulo"
            aria-describedby="helpId"
            placeholder="Titulo"
        />
        
       </div>

       <div class="mb-3">
        <label for="subtitulo" class="form-label">SUBTITULO</label>
        <input
            type="text"
            class="form-control"
            name="subtitulo"
            id="subtitulo"
            aria-describedby="helpId"
            placeholder="Subtitulo"
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
            placeholder="Imagen"
        />
        
       </div>

       <div class="mb-3">
        <label for="descripcion" class="form-label">DESCRIPCION</label>
        <input
            type="text"
            class="form-control"
            name="descripcion"
            id="descripcion"
            aria-describedby="helpId"
            placeholder="descripcion"
        />
        
       </div>

       <div class="mb-3">
        <label for="cliente" class="form-label">CLIENTE</label>
        <input
            type="text"
            class="form-control"
            name="cliente"
            id="cliente"
            aria-describedby="helpId"
            placeholder="El cliente"
        />
        
       </div>

       <div class="mb-3">
        <label for="categoria" class="form-label">CATEGORIA</label>
        <input
            type="text"
            class="form-control"
            name="categoria"
            id="categoria"
            aria-describedby="helpId"
            placeholder="Categoria"
        />
        
       </div>

       <div class="mb-3">
        <label for="url" class="form-label">URL</label>
        <input
            type="text"
            class="form-control"
            name="url"
            id="url"
            aria-describedby="helpId"
            placeholder="la direccion web"
        />
        
       </div>

       <button type="submit" class="btn btn-primary">AGREGAR</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">CANCELAR</a>
      </form>
    </div>
    


<?php include("../../templates/footer.php");

?>