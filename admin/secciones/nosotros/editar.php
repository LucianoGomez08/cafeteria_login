<?php include("../../bd.php");

if(isset($_GET['txtid'])){
  //Recuperamos los datos del ID seleccionado
  $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";

  $sentencia= $conexion->prepare("SELECT * FROM tbl_nosotros WHERE id=:id");
  $sentencia->bindParam(":id",$txtid);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);

  $titulo=$registro['titulo'];
  $subtitulo=$registro['subtitulo'];
  $descripcion=$registro['descripcion'];

  if($_POST){

      //recepcionamos los valores del formulario
      $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";
      $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
      $subtitulo=(isset($_POST['subtitulo']))?$_POST['subtitulo']:"";
      $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  
    
      $sentencia= $conexion->prepare("UPDATE `tbl_nosotros`
      SET 
      titulo=:titulo,
      subtitulo=:subtitulo,
      descripcion=:descripcion 
      WHERE id=:id");
    
      $sentencia->bindParam(":titulo",$titulo);
      $sentencia->bindParam(":subtitulo",$subtitulo);
      $sentencia->bindParam(":descripcion",$descripcion);
      $sentencia->bindParam(":id",$txtid);
      $sentencia->execute();  
  
  
      $mensaje="Registro modificado con exito.";
      header("Location:index.php?mensaje=".$mensaje);
    
    
    }
}
  
  

include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        agregar nuevo registro
    </div>
    <div class="card-body">
       
        <form action="" enctype="multipart/form-data" method="post">

        <div class="mb-3">
          <label for="txtid" class="form-label">Id:</label>
          <input type="text"
            class="form-control" readonly value="<?php echo $txtid;?>" name="txtid" id="txtid" aria-describedby="helpId" placeholder="id">
        </div>
        <div class="mb-3">
          <label for="titulo" class="form-label">Titulo:</label>
          <input type="text"
            class="form-control" value="<?php echo $titulo ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
        </div>
        <div class="mb-3">
          <label for="subtitulo" class="form-label">Subtitulo:</label>
          <input type="text"
            class="form-control" value="<?php echo $subtitulo;?>" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="subtitulo">
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripcion:</label>
          <input type="text"
            class="form-control" value="<?php echo $descripcion;?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
        </div>
           
                <button type="submit" class="btn btn-success">Agregar</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
     
    </div>
</div>

<?php include("../../templates/footer.php"); ?>