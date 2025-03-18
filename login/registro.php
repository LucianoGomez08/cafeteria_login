<?php include("../admin/bd.php");

if($_POST){
  
	//recepcionamos los valores del formulario
	$usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
	$password=(isset($_POST['password']))?$_POST['password']:"";
	$correo=(isset($_POST['correo']))?$_POST['correo']:"";
	


	$sentencia= $conexion->prepare("INSERT INTO `tbl_usuarios` 
	(`usuario`, `password`, `correo`) 
	VALUES (:usuario, :password, :correo);");
	
	$sentencia->bindParam(":usuario",$usuario);
	$sentencia->bindParam(":password",$password);
	$sentencia->bindParam(":correo",$correo);
	
	$sentencia->execute();  
  
  
	$mensaje="Registro agregado con exito.";
	header("Location:index.php");
  }
?>
<!doctype html>
<html lang="es">
  <head>
  	<title>Registro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	</head>
	<body class="img js-fullheight" style="background-image: url(../img/fotos/fondos/32.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Registrarse</h3>
		      	<form action="" class="signin-form" method="post" >
				  <br><br>
		      		<div class="form-group">
		      			<input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" name="password" type="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
				<div class="form-group">
		      			<input type="text" name="correo" class="form-control" placeholder="Correo" required>
		      	</div><br>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Registrarme</button>
	            </div>
				<div class="form-group">
					<a name="" id="" class="form-control btn btn-primary submit px-3" href="index.php" role="button">Cancelar</a>
	            </div>
	          </form>
		      </div>
				</div>
			</div>
		</div>
	</section>
	<script src="js1/jquery.min.js"></script>
  <script src="js1/popper.js"></script>
  <script src="js1/bootstrap.min.js"></script>
  <script src="js1/main.js"></script>
	</body>
</html>

