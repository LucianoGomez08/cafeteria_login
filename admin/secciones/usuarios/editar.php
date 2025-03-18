<?php include("../../bd.php");

if(isset($_GET['txtid'])){
    //Recuperamos los datos del ID seleccionado
    $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";

    $sentencia= $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtid);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $usuario=$registro['usuario'];
    $password=$registro['password'];
    $correo=$registro['correo']; 
    $id_rol=$registro['id_rol']; 

    if($_POST){
       

        //recepcionamos los valores del formulario
        $txtid=(isset($_POST['txtid']))?$_POST['txtid']:"";
        $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
        $password=(isset($_POST['password']))?$_POST['password']:"";
        $correo=(isset($_POST['correo']))?$_POST['correo']:"";
        $id_rol=(isset($_POST['id_rol']))?$_POST['id_rol']:"";

        $sentencia= $conexion->prepare("UPDATE `tbl_usuarios` 
        SET 
        usuario=:usuario,
        password=:password,
        correo=:correo,
        id_rol=:id_rol
        WHERE id=:id");

        $sentencia->bindParam(":usuario",$usuario);
        $sentencia->bindParam(":password",$password);
        $sentencia->bindParam(":correo",$correo);
        $sentencia->bindParam(":id_rol",$id_rol);
        $sentencia->bindParam(":id",$txtid);
        $sentencia->execute();

        $mensaje="Registro modificado con exito.";
        header("Location:index.php?mensaje=".$mensaje);
    }
}


include("../../templates/header.php");?>

<div class="card">
        <div class="card-header">
            Usuarios
        </div>
        <div class="card-body">
            
        <form action="" method="post" enctype="multipart/form-data" >

        <div class="mb-3">
          <label for="txtid" class="form-label">Id:</label>
          <input type="text" readonly
            class="form-control" value="<?php echo $txtid ?>" name="txtid" id="txtid" aria-describedby="helpId" placeholder="id">
        </div>

        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario:</label>
          <input type="text"
            class="form-control" value="<?php echo $usuario ?>" name="usuario" id="usuario" aria-describedby="helpId" placeholder="usuario">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="text"
            class="form-control" value="<?php echo $password ?>" name="password" id="password" aria-describedby="helpId" placeholder="password">
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo Electroniico:</label>
          <input type="text"
            class="form-control" value="<?php echo $correo ?>" name="correo" id="correo" aria-describedby="helpId" placeholder="correo electronico">
        </div>

        <div class="mb-3">
          <label for="id_rol" class="form-label">Rol:</label>
          <input type="text"
            class="form-control" value="<?php echo $id_rol ?>" name="id_rol" id="id_rol" aria-describedby="helpId" placeholder="rol">
        </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>


        </div>
        <div class="card-footer text-muted">
            
        </div>
    </div>



<?php include("../../templates/footer.php"); ?>