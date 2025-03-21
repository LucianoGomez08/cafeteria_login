<?php include("admin/bd.php");
include("carrito_de_compras/carrito.php");

      //MOSTRAMOS LOS REGISTROS DE MENU 
$sentencia= $conexion->prepare("SELECT * FROM `tbl_reservas`"); 
$sentencia->execute();
$lista_reservas=$sentencia->fetchAll(PDO::FETCH_ASSOC);

 //MOSTRAMOS LA CONFIGURACION GENERAL
 $sentencia= $conexion->prepare("SELECT * FROM `tbl_configuraciones`"); 
 $sentencia->execute();
 $lista_configuraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);


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
  }

  use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHP-mailer/Exception.php';
require 'PHP-mailer/PHPMailer.php';
require 'PHP-mailer/SMTP.php';


$errores = '';
$enviado = '';
$ruta = 'img/fotos/logos/2.jpg';
$cid='';
// Comprobamos que el formulario haya sido enviado.
if (isset($_POST['submit'])) {
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

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
    $mail->Subject = 'Cafeteria Malusa. Reserva';
    $mail->Body    = '<h2>Sr/a ' .$nombre .' Usted realizo una reservacion para el dia<h2/> ' .$fecha .' a las '. $hora. 
    ' Hs<h2/><br/><br/> <h2>GRACIAS POR ELEGIRNOS<h2/>';
    $mail->AddEmbeddedImage($ruta,$cid,$cid);
    $mail->send();

    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
		
	}
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
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Reservaciones</h1>
        </div>
    </div>
    <!-- Page Header End -->

        <!-- Reservation Start -->
        <div class="container-fluid my-5">
        <div class="container">
            <div class="reservation position-relative overlay-top overlay-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-5 my-lg-0">
                        <div class="p-5">
                            <div class="mb-2">
                                <h1 class="display-6 text-primary"><?php echo $lista_configuraciones[8]['valor'];?></h1>
                                <h1 class="text-white"><?php echo $lista_configuraciones[9]['valor'];?></h1>
                            </div>
                            <p class="text-white"><?php echo $lista_configuraciones[10]['valor'];?></p>
                            <ul class="list-inline text-white m-0">
                                <li class="py-2"><i class="fa fa-check text-primary mr-3"></i><?php echo $lista_configuraciones[11]['valor'];?></li>
                                <li class="py-2"><i class="fa fa-check text-primary mr-3"></i><?php echo $lista_configuraciones[12]['valor'];?></li>
                                <li class="py-2"><i class="fa fa-check text-primary mr-3"></i><?php echo $lista_configuraciones[13]['valor'];?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center p-5" style="background: rgba(51, 33, 29, .8);">
                            <h1 class="text-white mb-4 mt-5"><?php echo $lista_configuraciones[15]['valor'];?></h1>

                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="form-group">
                                    <input type="text" id="nombre" class="form-control bg-transparent border-primary p-4" placeholder="Nombre" name="nombre"
                                        required="required" value="<?php if(!$enviado && isset($nombre))?>"/>
                                </div>
                                <div class="form-group">
                                    <input type="email" id="correo" class="form-control bg-transparent border-primary p-4" placeholder="Email" name="correo"
                                        required="required" value="<?php if(!$enviado && isset($correo))?>"/>
                                </div>
                                <div class="form-group">
                                    <div class="date" id="fecha" data-target-input="nearest">
                                        <input type="text"  class="form-control bg-transparent border-primary p-4 datetimepicker-input" placeholder="Fecha" 
                                        name="fecha" data-target="#date" data-toggle="datetimepicker" value="<?php if(!$enviado && isset($fecha))?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="time" id="hora" data-target-input="nearest">
                                        <input type="text" class="form-control bg-transparent border-primary p-4 datetimepicker-input" placeholder="Hora"  
                                        name="hora" data-target="#time" data-toggle="datetimepicker" value="<?php if(!$enviado && isset($hora))?>"/>
                                    </div>
                                </div>                              
                                <div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-block font-weight-bold py-3" ><?php echo $lista_configuraciones[16]['valor'];?></button>
                                </div>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reservation End -->


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