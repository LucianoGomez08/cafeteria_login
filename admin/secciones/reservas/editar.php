<?php include("../../bd.php");

if(isset($_GET['txtid'])){
  //Recuperamos los datos del ID seleccionado
  $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";

  $sentencia= $conexion->prepare("SELECT * FROM tbl_reservas WHERE id=:id");
  $sentencia->bindParam(":id",$txtid);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);

  $nombre=$registro['nombre'];
  $correo=$registro['correo'];
  $fecha=$registro['fecha'];
  $hora=$registro['hora'];

  if($_POST){

      //recepcionamos los valores del formulario
      $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";
      $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
      $correo=(isset($_POST['correo']))?$_POST['correo']:"";
      $fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";
      $hora=(isset($_POST['hora']))?$_POST['hora']:"";
  
    
      $sentencia= $conexion->prepare("UPDATE `tbl_reservas`
      SET 
      nombre=:nombre,
      correo=:correo,
      fecha=:fecha,
      hora=:hora 
      WHERE id=:id");
    
      $sentencia->bindParam(":nombre",$nombre);
      $sentencia->bindParam(":correo",$correo);
      $sentencia->bindParam(":fecha",$fecha);
      $sentencia->bindParam(":hora",$hora);
      $sentencia->bindParam(":id",$txtid);
      $sentencia->execute();  
  
  
      $mensaje="Registro modificado con exito.";
      header("Location:index.php?mensaje=".$mensaje);
    
    
    }
}
  
  

include("../../templates/header.php");?>
<div class="card">
    <div class="card-header">
        Editar reserva
    </div>
    <div class="card-body">
       
        <form action="" enctype="multipart/form-data" method="post">
        
        <div class="mb-3">
          <label for="txtid" class="form-label">Id:</label>
          <input type="text"
            class="form-control" readonly value="<?php echo $txtid;?>"name="txtid" id="txtid" aria-describedby="helpId" placeholder="id">
        </div>
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text"
            class="form-control" value="<?php echo $nombre;?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="nombre">
        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input type="text"
            class="form-control"  value="<?php echo $correo;?>" name="correo" id="correo" aria-describedby="helpId" placeholder="correo">
        </div>
        <div class="mb-3">
          <label for="fecha" class="form-label">Fecha:</label>
          <input type="text"
            class="form-control" value="<?php echo $fecha;?>" name="fecha" id="fecha" aria-describedby="helpId" placeholder="fecha">
        </div>
        <div class="mb-3">
          <label for="hora" class="form-label">Hora de la reserva:</label>
          <input type="text"
            class="form-control" value="<?php echo $hora;?>"name="hora" id="hora" aria-describedby="helpId" placeholder="hora de la reserva">
        </div>
           
                <button type="submit" class="btn btn-success">Aceptar</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
     
    </div>
</div>

<?php include("../../templates/footer.php"); ?>