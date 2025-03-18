<!doctype html>
<html lang="es">
  <head> 
  	<title>Malusa Coffee</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	</head>
	<body class="img js-fullheight" style="background-image: url(../img/fotos/fondos/13.jpg);">
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
					<br><br>
		      	<h3 class="mb-4 text-center">Ingrese su nueva contraseña</h3>
				<br>
				<form action="new_pass.php" method="post">
				<div class="form-group">
		      			<input type="password" id="password-field" name="new_password" id="new_password" class="form-control" placeholder="Nueva contraseña">
						<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" >
		      		</div><br>
	            <div class="form-group">
	            	<button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Restablecer</button>
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

