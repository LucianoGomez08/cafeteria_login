<?php include("../../bd.php");

if($_POST){
  
	//recepcionamos los valores del formulario
	$usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
	$password=(isset($_POST['password']))?$_POST['password']:"";
	$correo=(isset($_POST['correo']))?$_POST['correo']:"";
  $id_rol=(isset($_POST['id_rol']))?$_POST['id_rol']:"";
	
  echo $usuario;

	$sentencia= $conexion->prepare("INSERT INTO `tbl_usuarios` 
	(`usuario`, `password`, `correo`, `id_rol`) 
	VALUES (:usuario, :password, :correo, :id_rol);");
	
	$sentencia->bindParam(":usuario",$usuario);
	$sentencia->bindParam(":password",$password);
	$sentencia->bindParam(":correo",$correo);
  $sentencia->bindParam(":id_rol",$id_rol);
	
	$sentencia->execute();  
  
  
	$mensaje="Registro agregado con exito.";
	header("Location:index.php?mensaje=".$mensaje);
  
  
  
  }

include("../../templates/header.php");?>



<div class="card">
        <div class="card-header">
            Usuarios
        </div>
        <div class="card-body">
            
        <form action="" method="post" enctype="multipart/form-data" >

        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario:</label>
          <input type="text"
            class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="usuario">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="text"
            class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="password">
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo Electronico:</label>
          <input type="text"
            class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="correo electronico">
        </div>

        <div class="mb-3">
          <label for="id_rol" class="form-label">Rol:</label>
          <input type="text"
            class="form-control" name="id_rol" id="id_rol" aria-describedby="helpId" placeholder="rol">
        </div>

            <button type="submit" class="btn btn-success">Agragar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>


        </div>
        <div class="card-footer text-muted">
            
        </div>
    </div>




<?php include("../../templates/footer.php"); ?>