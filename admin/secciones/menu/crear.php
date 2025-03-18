<?php include("../../bd.php");

if($_POST){
  
  $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
  $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
  $precio=(isset($_POST['precio']))?$_POST['precio']:"";

  $fecha_imagen=new DateTime();
  $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

  $tmp_imagen=$_FILES["imagen"]["tmp_name"];

  if($tmp_imagen!=""){
    move_uploaded_file($tmp_imagen,"../../../img/".$nombre_archivo_imagen);
  }
  
  $sentencia= $conexion->prepare("INSERT INTO `tbl_menu`
  (`id`, `titulo`, `descripcion`, `precio`, `imagen`) 
  VALUES (NULL, :titulo, :descripcion, :precio, :imagen);");
  
  
  $sentencia->bindParam(":titulo",$titulo);
  $sentencia->bindParam(":descripcion",$descripcion);
  $sentencia->bindParam(":precio",$precio);
  $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
  $sentencia->execute(); 

  $mensaje="Registro agregdo con exito.";
  header("Location:index.php?mensaje=".$mensaje);

}

include("../../templates/header.php")
?>

<div class="card">
    <div class="card-header">
        Crear menu
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
           
            <div class="mb-3">
              <label for="titulo" class="form-label">Titulo:</label>
              <input type="text"
                class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción:</label>
              <input type="text"
                class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
            </div>
            <div class="mb-3">
              <label for="precio" class="form-label">Precio:</label>
              <input type="text"
                class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="precio">
            </div>
            <div class="mb-3">
              <label for="imagen" class="form-label">Imagen:</label>
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