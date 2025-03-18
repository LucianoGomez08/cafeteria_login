<?php include("../../bd.php");

if($_POST){
  
    //recepcionamos los valores del formulario
    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $valor=(isset($_POST['valor']))?$_POST['valor']:"";

      $sentencia= $conexion->prepare("INSERT INTO `tbl_configuraciones` 
      (`id`,`nombre`, `valor`)
      VALUES (NULL, :nombre, :valor);");
    
      $sentencia->bindParam(":nombre",$nombre);
      $sentencia->bindParam(":valor",$valor);
     
      $sentencia->execute();  
      $mensaje="Registro agregado con exito.";
      header("Location:index.php?mensaje=".$mensaje);
  }
  
include("../../templates/header.php");?>


<div class="card">
    <div class="card-header">
        agregar nueva configuracion
    </div>
    <div class="card-body">
       
        <form action="" enctype="multipart/form-data" method="post">
        
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre de la configuracion:</label>
          <input type="text"
            class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre de la configuracion">
        </div>
           <div class="mb-3">
              <label for="valor" class="form-label">Valor:</label>
              <input type="text"
                class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="valor">
            </div>

                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted">
     
    </div>
</div>


<?php include("../../templates/footer.php"); ?>