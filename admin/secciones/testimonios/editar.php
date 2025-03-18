<?php include("../../bd.php");


if(isset($_GET['txtid'])){

  $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";


  $sentencia= $conexion->prepare("SELECT * FROM tbl_testimonios WHERE id=:id");
  $sentencia->bindParam(":id",$txtid);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);

  $nombre=$registro['nombre'];
  $profesion=$registro['profesion'];
  $descripcion=$registro['descripcion'];
  $imagen=$registro['imagen'];
 
  if($_POST){
    //Recibo de la DB los datos

    $txtid=(isset($_POST['txtid']))?$_POST['txtid']:"";
    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $profesion=(isset($_POST['profesion']))?$_POST['profesion']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
   
    //Actualizo en la DB los datos
    $sentencia= $conexion->prepare("UPDATE `tbl_testimonios` 
    SET 
    nombre=:nombre,
    profesion=:profesion,
    descripcion=:descripcion 
    WHERE id=:id ");
    
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":profesion",$profesion);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":id",$txtid);
    $sentencia->execute(); 

    if($_FILES["imagen"]["tmp_name"]!=""){

      $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
      $fecha_imagen=new DateTime();
      $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";
  
      $tmp_imagen=$_FILES["imagen"]["tmp_name"];
     
      move_uploaded_file($tmp_imagen,"../../../img/".$nombre_archivo_imagen);

    //Borro el archivo anterior
    $sentencia= $conexion->prepare("SELECT imagen FROM tbl_testimonios WHERE id=:id");
    $sentencia->bindParam(":id",$txtid);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registro_imagen["imagen"])){
            if(file_exists("../../../img/".$registro_imagen["imagen"])){
                unlink("../../../img/".$registro_imagen["imagen"]);
            }
        }

      $sentencia= $conexion->prepare("UPDATE tbl_testimonios SET imagen=:imagen WHERE id=:id");
      $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
      $sentencia->bindParam(":id",$txtid);
      $sentencia->execute();
      $imagen=$nombre_archivo_imagen;
    }
    $mensaje="Registro modificado con exito.";
    header("Location:index.php?mensaje=".$mensaje);
  }
 
}



include("../../templates/header.php");?>


<div class="card">
    <div class="card-header">
        Editar testimonio
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
              <label for="txtid" class="form-label">Id:</label>
              <input type="text"
                class="form-control" readonly value="<?php echo $txtid;?>" name="txtid" id="txtid" aria-describedby="helpId" placeholder="id">
            </div>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text"
                class="form-control" value="<?php echo $nombre;?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="nombre">
            </div>
            <div class="mb-3">
              <label for="profesion" class="form-label">Profesion:</label>
              <input type="text"
                class="form-control" value="<?php echo $profesion;?>" name="profesion" id="profesion" aria-describedby="helpId" placeholder="profesion">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción:</label>
              <input type="text"
                class="form-control" value="<?php echo $descripcion;?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
            </div>
            <div class="mb-3">
              <label for="imagen" class="form-label">Imagen:</label>
              <img width="70" src="../../../img/<?php echo $imagen;?>"/>
              <input type="file" class="form-control" name="imagen" id="imagen" placeholder="imagen" aria-describedby="fileHelpId">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>

            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>

    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>

<?php include("../../templates/footer.php"); ?>