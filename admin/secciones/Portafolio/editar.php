<?php 

include ("../../bd.php");

if(isset($_GET['txtID'])){
    //recuperamos los datos del ID

    $txtID=(isset($_GET['txtID'])) ? $_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_portafolio` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $titulo=$registro['titulo'];
    $subtitulo=$registro['subtitulo'];
    $imagen=$registro['imagen'];
    $descripcion=$registro['descripcion'];
    $cliente=$registro['cliente'];
    $categoria=$registro['categoria'];
    $url=$registro['url'];
}


if($_POST){//insertamos los cambios 
    

    $txtID=(isset($_POST['txtID'])) ? $_POST['txtID']:"";
    
    $titulo=(isset($_POST['titulo'])) ? $_POST['titulo']:"";
    $subtitulo=(isset($_POST['subtitulo'])) ? $_POST['subtitulo']:"";

    

    $descripcion=(isset($_POST['descripcion'])) ? $_POST['descripcion']:"";
    $cliente=(isset($_POST['cliente'])) ? $_POST['cliente']:"";
    $categoria=(isset($_POST['categoria'])) ? $_POST['categoria']:"";
    $url=(isset($_POST['url'])) ? $_POST['url']:"";


    $sentencia=$conexion->prepare("UPDATE `tbl_portafolio` SET titulo=:titulo,subtitulo=:subtitulo,
    descripcion=:descripcion,cliente=:cliente,categoria=:categoria,url=:url 
    WHERE id=:id");

   
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":subtitulo",$subtitulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":cliente",$cliente);
    $sentencia->bindParam(":categoria",$categoria);
    $sentencia->bindParam(":url",$url);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    if($_FILES["imagen"]["tmp_name"]!=""){

    $imagen=(isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name']:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../../../assets/img/portfolio/".$nombre_archivo_imagen);
    }

   //borrado de la imagen cuando se cambia
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


    $sentencia=$conexion->prepare("UPDATE `tbl_portafolio` SET imagen=:imagen
    WHERE id=:id");

    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    
  

}

$mensaje="¡¡Registro actualizado  con exito!!";

header("location:index.php?mensaje=".$mensaje);
}
include("../../templates/header.php");

?>
<div class="card">

<div class="card-header">
    EDITAR EL PORTAFOLIO
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
        placeholder="ID"
    />
   </div>

   <div class="mb-3">
    <label for="titulo" class="form-label">TITULO</label>
    <input value="<?php echo $titulo;?>"
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
    <input value="<?php echo $subtitulo ;?>"
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

    <img  width="80"src="../../../assets/img/portfolio/<?php echo $imagen ;?>"/>
    
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
    <input value="<?php echo $descripcion ;?>"
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
    <input value="<?php echo $cliente ;?>"
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
    <input value="<?php echo $categoria ;?>"
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
    <input value="<?php echo $url ;?>"
        type="text"
        class="form-control"
        name="url"
        id="url"
        aria-describedby="helpId"
        placeholder="la direccion web"
    />
    
   </div>

   <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button">PORTAFOLIO</a>
  </form>
</div>



<?php include("../../templates/footer.php");

?>