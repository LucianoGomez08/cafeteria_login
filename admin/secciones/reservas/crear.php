<?php include("../../bd.php");

if($_POST){
  
    //recepcionamos los valores del formulario
    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";
    $fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";
    $hora=(isset($_POST['hora']))?$_POST['hora']:"";
  
    $sentencia= $conexion->prepare("INSERT INTO `tbl_reservas` (`id`,`nombre`,`correo`,`fecha`, `hora`)
    VALUES (NULL, :nombre, :correo, :fecha, :hora);");
  
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":fecha",$fecha);
    $sentencia->bindParam(":hora",$hora);
  
  
    $sentencia->execute();  
    $mensaje="Registro agregado con exito.";
    header("Location:index.php?mensaje=".$mensaje);
  
  
  }
  
include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        agregar nueva reserva
    </div>
    <div class="card-body">
       
        <form action="" enctype="multipart/form-data" method="post">
        
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text"
            class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="nombre">
        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input type="text"
            class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="correo">
        </div>
        <div class="mb-3">
          <label for="fecha" class="form-label">Fecha:</label>
          <input type="text"
            class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="fecha">
        </div>
        <div class="mb-3">
          <label for="hora" class="form-label">Hora de la reserva:</label>
          <input type="text"
            class="form-control" name="hora" id="hora" aria-describedby="helpId" placeholder="hora de la reserva">
        </div>
           
                <button type="submit" class="btn btn-success">Agregar</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
     
    </div>
</div>

<?php include("../../templates/footer.php"); ?>