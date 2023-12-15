<?php

include("../../bd.php");

if(isset($_GET['txtID'])){
    //recuperamos los datos del ID

    $txtID=(isset($_GET['txtID'])) ? $_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $nombreconfiguracion=$registro['nombreconfiguracion'];
    $valor=$registro['valor'];
   
    
    
}


if($_POST){//insertamos los cambios 
      print_r($_POST);
      $txtID=(isset($_POST['txtID'])) ? $_POST['txtID']:"";
      $nombreconfiguracion=(isset($_POST['nombreconfiguracion'])) ? $_POST['nombreconfiguracion']:"";
      $valor=(isset($_POST['valor'])) ? $_POST['valor']:"";
      
  
  
      $sentencia=$conexion->prepare("UPDATE `tbl_configuraciones` SET nombreconfiguracion=:nombreconfiguracion,valor=:valor
       WHERE id=:id");
  
      $sentencia->bindParam(":nombreconfiguracion",$nombreconfiguracion);
      $sentencia->bindParam(":valor",$valor);
      $sentencia->bindParam(":id",$txtID);
      $sentencia->execute();
      
      $mensaje="¡¡configuracion actualizada con exito!!";

      header("location:index.php?mensaje=".$mensaje);
  
  }





include("../../templates/header.php");

?>


<div class="card">

    <div class="card-header">
      EDITAMOS  CONFIGURACION;
    </div>

    <div class="card-body">

      <form action="" method="post">

     <div class="mb-3">
        <label for="txtID" class="form-label">ID</label>
        <input readonly value="<?php echo $txtID;?>"
            type="text"
            class="form-control"
            name="txtID"
            id="txtID"
            aria-describedby="helpId"
            placeholder="identificacion"
        />
        
     </div>

     <div class="mb-3">
        <label for="nombreconfiguracion" class="form-label">NOMBRE</label>
        <input
        value="<?php echo $nombreconfiguracion;?>"
            type="text"
            class="form-control"
            name="nombreconfiguracion"
            id="nombreconfiguracion"
            aria-describedby="helpId"
            placeholder="nombre de la configuracion"
        />
        
     </div>

     <div class="mb-3">
        <label for="valor" class="form-label">VALOR</label>
        <input
             value="<?php echo $valor;?>"
            type="text"
            class="form-control"
            name="valor"
            id="valor"
            aria-describedby="helpId"
            placeholder="valor de la configuracion"
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