<?php include("admin/bd.php");
      include("carrito_de_compras/carrito.php");
      
//MOSTRAMOS LOS REGISTROS DE NOSOTROS
$sentencia= $conexion->prepare("SELECT * FROM `tbl_configuraciones`"); 
$sentencia->execute();
$lista_configuraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHP-mailer/Exception.php';
require 'PHP-mailer/PHPMailer.php';
require 'PHP-mailer/SMTP.php';


$errores = '';
$enviado = '';

// Comprobamos que el formulario haya sido enviado.
if (isset($_POST['submit'])) {
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$mensaje = $_POST['mensaje'];
    $asunto = $_POST['asunto'];

// Comprobamos que el nombre no este vacio.
	if (!empty($nombre)) {

		// Saneamos el nombre para eliminar caracteres que no deberian estar.
		$nombre = trim($nombre);
		$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
		
        // Comprobamos que el nombre despues de quitar los caracteres ilegales no este vacio.
		if ($nombre == "") {
			$errores.= 'Por favor ingresa un nombre.<br />';
		}
	} else {
		$errores.= 'Por favor ingresa un nombre.<br />';
	}

	if (!empty($correo)) {
		$correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
		// Comprobamos que sea un correo valido
		if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
			$errores.= "Por favor ingresa un correo valido.<br />";
		}
	} else {
		$errores.= 'Por favor ingresa un correo.<br />';
	}


	if (!empty($mensaje)) {
		// Podemos sanear la cadena de texto con filter_var, pero queremos que en el mensaje los signos se conviertan en entidades HTML
		$mensaje = htmlspecialchars($mensaje);
		$mensaje = trim($mensaje);
		$mensaje = stripslashes($mensaje);
	} else {
		$errores.= 'Por favor ingresa el mensaje.<br />';
	}

// Comprobamos si hay errores, si no hay entonces enviamos.
	if (!$errores) {
		
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'malusacoffee@hotmail.com';                     //SMTP username
    $mail->Password   = 'Malusa2024';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('malusacoffee@hotmail.com');
    $mail->addAddress($correo);     //Add a recipient
    
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $mensaje;
    $mail->send();

    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
		
	}
}
if($_POST){
  
	//recepcionamos los valores del formulario
	$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
	$asunto=(isset($_POST['asunto']))?$_POST['asunto']:"";
	$correo=(isset($_POST['correo']))?$_POST['correo']:"";
    $mensaje=(isset($_POST['mensaje']))?$_POST['mensaje']:"";

	$sentencia= $conexion->prepare("INSERT INTO `tbl_mensajes` 
	(`nombre`, `asunto`, `correo`, `mensaje`) 
	VALUES (:nombre, :asunto, :correo, :mensaje);");
	
	$sentencia->bindParam(":nombre",$nombre);
	$sentencia->bindParam(":asunto",$asunto);
	$sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":mensaje",$mensaje);
	
	$sentencia->execute();  
  
  
  }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Proyecto final</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/style.min.css" rel="stylesheet">
</head>
<body>
   <!-- Navbar Start -->
    
   <div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <img src="img/fotos/logos/4-removebg-preview.png" width="200" height="200">
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="nosotros.php" class="nav-item nav-link">Nosotros</a>
                <a href="servicios.php" class="nav-item nav-link">Servicios</a>
                <a href="menu.php" class="nav-item nav-link">Menu</a>    
                <a href="reservas.php" class="nav-item nav-link">Reservaciones</a>
                <a href="testimonios.php" class="nav-item nav-link">Testimonios</a>
                <a href="contactanos.php" class="nav-item nav-link">Contactanos</a>
                <?php if(!isset($_SESSION['logueado'])){ ?>
                    <a href="login/index.php" class="nav-item nav-link"><i class="fas fa-user fa-fw"></i></a>  
                <?php } ?>
                <?php if(isset($_SESSION['logueado'])){ ?>
                    <a href="index.php?cerrar_sesion=1" class="nav-item nav-link">Cerrar sesion</a>  
                <?php } ?>
            </div>
        </div>  
    </nav>
</div>
        <div class="container">
        </div>
    </div>
    </div>

    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Contactanos</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h1 class="display-4">Siéntase libre de contactarnos</h1>
            </div>
            <div class="row px-3 pb-2">
                <div class="col-sm-4 text-center mb-3">
                    <i class="fa fa-2x fa-map-marker-alt mb-3 text-primary"></i>
                    <h4 class="font-weight-bold">Direccion</h4>
                    <p><?php echo $lista_configuraciones[20]['valor'];?></p>
                </div>
                <div class="col-sm-4 text-center mb-3">
                    <i class="fa fa-2x fa-phone-alt mb-3 text-primary"></i>
                    <h4 class="font-weight-bold">Telefono</h4>
                    <p><?php echo $lista_configuraciones[21]['valor'];?></p>
                </div>
                <div class="col-sm-4 text-center mb-3">
                    <i class="far fa-2x fa-envelope mb-3 text-primary"></i>
                    <h4 class="font-weight-bold">Email</h4>
                    <p><?php echo $lista_configuraciones[22]['valor'];?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pb-5">
                    <iframe style="width: 100%; height: 443px;" src="img/fotos/ubicacion.jpg"></iframe>"
                </div>
                <div class="col-md-6 pb-5">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="control-group">
                                <input type="text" name="nombre" id="nombre" class="form-control bg-transparent p-4"  placeholder="Nombre" value="<?php if(!$enviado && isset($nombre))?>"
                                    required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" name="correo" id="correo" class="form-control bg-transparent p-4"  placeholder="Email" value="<?php if(!$enviado && isset($correo))?>"
                                    required="required" data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" name="asunto" id="asunto" class="form-control bg-transparent p-4"  placeholder="Asunto" value="<?php if(!$enviado && isset($asunto))?>"
                                    required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea name="mensaje" id="mensaje" class="form-control bg-transparent py-3 px-4" rows="5"  placeholder="Mensaje"value="<?php if(!$enviado && isset($mensaje))?>"
                                    required="required"
                                    data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button type="submit" name="submit" class="btn btn-primary font-weight-bold py-3 px-5">Enviar mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-">
        <div class="col-lg-3 col-md-6 mb-5">
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;"><?php echo $lista_configuraciones[19]['valor'];?></h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i><?php echo $lista_configuraciones[20]['valor'];?></p>
                <p><i class="fa fa-phone-alt mr-2"></i><?php echo $lista_configuraciones[21]['valor'];?></p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i><?php echo $lista_configuraciones[22]['valor'];?></p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;"><?php echo $lista_configuraciones[23]['valor'];?></h4>
                <div>
                    <h6 class="text-white text-uppercase"><?php echo $lista_configuraciones[24]['valor'];?></h6>
                    <p><?php echo $lista_configuraciones[25]['valor'];?></p>
                    <h6 class="text-white text-uppercase"><?php echo $lista_configuraciones[26]['valor'];?></h6>
                    <p><?php echo $lista_configuraciones[27]['valor'];?></p>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white"><?php echo $lista_configuraciones[28]['valor'];?> &copy; <a class="font-weight-bold" href="#"><?php echo $lista_configuraciones[29]['valor'];?></a>. <br><?php echo $lista_configuraciones[30]['valor'];?></a></p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>