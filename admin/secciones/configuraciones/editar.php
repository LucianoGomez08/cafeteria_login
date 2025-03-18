<?php include("../../bd.php");

if(isset($_GET['txtid'])){
  //Recuperamos los datos del ID seleccionado
  $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";

  $sentencia= $conexion->prepare("SELECT * FROM tbl_configuraciones WHERE id=:id");
  $sentencia->bindParam(":id",$txtid);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);

  $nombre=$registro['nombre'];
  $valor=$registro['valor'];

  if($_POST){

      //recepcionamos los valores del formulario
      $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";
      $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
      $valor=(isset($_POST['valor']))?$_POST['valor']:"";
  
    
      $sentencia= $conexion->prepare("UPDATE `tbl_configuraciones`
      SET 
      nombre=:nombre,
      valor=:valor 
      WHERE id=:id");
    
      $sentencia->bindParam(":nombre",$nombre);
      $sentencia->bindParam(":valor",$valor);
      $sentencia->bindParam(":id",$txtid);
      $sentencia->execute();  
  
  
      $mensaje="Registro modificado con exito.";
      header("Location:index.php?mensaje=".$mensaje);
    
    
    }
}
  
  

include("../../templates/header.php");?>


<div class="card">
    <div class="card-header">
        Editar configuracion
    </div>
    <div class="card-body">
       
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
          <label for="txtid" class="form-label">Id:</label>
          <input type="text"
            class="form-control" readonly name="txtid" id="txtid" value="<?php echo $txtid ?>" aria-describedby="helpId" placeholder="id">
        </div>
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre de la configuracion:</label>
          <input type="text"
            class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>" aria-describedby="helpId" placeholder="Nombre de la configuracion">
        </div>
           <div class="mb-3">
              <label for="valor" class="form-label">Valor:</label>
              <input type="text"
                class="form-control" name="valor" id="valor" value="<?php echo $valor ?>" aria-describedby="helpId" placeholder="valor">
            </div>

                    <button type="submit" class="btn btn-success">Editar</button>
                    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted">
     
    </div>
</div>


<?php include("../../templates/footer.php"); ?>