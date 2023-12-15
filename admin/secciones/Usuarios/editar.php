<?php 

include ("../../bd.php");



if(isset($_GET['txtID'])){
    //recuperamos los datos del ID

    $txtID=(isset($_GET['txtID'])) ? $_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_usuarios` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $usuario=$registro['usuario'];
    $password=$registro['password'];
    $correo=$registro['correo'];
    
    
}


if($_POST){//insertamos los cambios 
      print_r($_POST);
      $txtID=(isset($_POST['txtID'])) ? $_POST['txtID']:"";
      $usuario=(isset($_POST['usuario'])) ? $_POST['usuario']:"";
      $password=(isset($_POST['password'])) ? $_POST['password']:"";
      $correo=(isset($_POST['correo'])) ? $_POST['correo']:"";
  
  
      $sentencia=$conexion->prepare("UPDATE `tbl_usuarios` SET usuario=:usuario, password=:password,
      correo=:correo WHERE id=:id");
  
      $sentencia->bindParam(":usuario",$usuario);
      $sentencia->bindParam(":password",$password);
      $sentencia->bindParam(":correo",$correo);
      $sentencia->bindParam(":id",$txtID);
      $sentencia->execute();
      
      $mensaje="¡¡Usuario actualizado con exito!!";

      header("location:index.php?mensaje=".$mensaje);
  
  }

include("../../templates/header.php");

?>





<div class="card">

    <div class="card-header">

    Editamos nuevo usuario

    </div>

    <div class="card-body">

     <form action="" method="post">

     <div class="mb-3">
        <label for="txtID" class="form-label">ID</label>
        <input
        readonly value="<?php echo $txtID;?>"
            type="text"
            class="form-control"
            name="txtID"
            id="txtID"
            aria-describedby="helpId"
            placeholder="nombre del usuario"
        />
        
    </div>


    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input
        value="<?php echo $usuario;?>"
            type="text"
            class="form-control"
            name="usuario"
            id="usuario"
            aria-describedby="helpId"
            placeholder="nombre del usuario"
        />
        
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input
        value="<?php echo $password;?>"
            type="password"
            class="form-control"
            name="password"
            id="password"
            aria-describedby="helpId"
            placeholder="escriba su contraseña"
        />
        
    </div>

    <div class="mb-3">
        <label for="correo" class="form-label">Correo Electronico</label>
        <input
        value="<?php echo $correo;?>"
            type="email"
            class="form-control"
            name="correo"
            id="correo"
            aria-describedby="helpId"
            placeholder="escriba su correo electronico"
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