<?php 
include("../../bd.php");

if($_POST){
    //  print_r($_POST);
  
    
      $nombreconfiguracion=(isset($_POST['nombreconfiguracion'])) ? $_POST['nombreconfiguracion']:"";
      $valor=(isset($_POST['valor'])) ? $_POST['valor']:"";
  
  
      $sentencia=$conexion->prepare("INSERT INTO `tbl_configuraciones` (`ID`, `nombreconfiguracion`, `valor`) 
      VALUES (NULL,:nombreconfiguracion,:valor)");
  
      $sentencia->bindParam(":nombreconfiguracion",$nombreconfiguracion);
      $sentencia->bindParam(":valor",$valor);
     
  
  
      $sentencia->execute();
  
      $mensaje="¡¡configuracion creada con exito!!";
  
      header("location:index.php?mensaje=".$mensaje);
  
  
  }



include("../../templates/header.php");

?>

<div class="card">

    <div class="card-header">
        CONFIGURACION;
    </div>

    <div class="card-body">

      <form action="" method="post">

      <div class="mb-3">
        <label for="nombreconfiguracion" class="form-label">NOMBRE</label>
        <input
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
            type="text"
            class="form-control"
            name="valor"
            id="valor"
            aria-describedby="helpId"
            placeholder="valor de la configuracion"
        />
        
     </div>
     

     <button type="submit" class="btn btn-primary">AGREGAR CONFIGURACION</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">CANCELAR</a>


      </form>
    </div>

    <div class="card-footer text-muted"></div>
</div>



<?php include("../../templates/footer.php");

?>