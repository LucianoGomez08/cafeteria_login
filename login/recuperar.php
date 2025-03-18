<?php
include('../admin/bd.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHP-mailer/Exception.php';
require '../PHP-mailer/PHPMailer.php';
require '../PHP-mailer/SMTP.php';

$correo=$_POST['correo'];
$sentencia= $conexion->prepare("SELECT * FROM `tbl_usuarios` WHERE `tbl_usuarios`.`correo` ='$correo'");
$sentencia->execute();
$registros=$sentencia->fetch(PDO::FETCH_LAZY);
$id=$registros['id'];


if(!$registros = 0){


    $errores = '';
    $enviado = '';

    // Comprobamos que el formulario haya sido enviado.
    if (isset($_POST['submit'])) {
        
        $correo = $_POST['correo'];


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
        $mail->Username   = 'maximilianojlopez@hotmail.com';                     //SMTP username
        $mail->Password   = 'Mailen13082019';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('maximilianojlopez@hotmail.com');
        $mail->addAddress($correo);     //Add a recipient
        
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Restablecer password';
        $mail->Body ='<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet" type="text/css">
        </head>
        <main class="container" >
        <div class="card-body">
        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ecf0f1;color: #000000">
          <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ecf0f1;width:100%" cellpadding="0" cellspacing="0">
          <tbody>
          <tr style="vertical-align: top">
            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
        <div class="u-row-container" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
        <div id="u_column_2" class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
          <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <div class="v-col-border" style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 15px solid #8d95ff;border-left: 15px solid #8d95ff;border-right: 15px solid #8d95ff;border-bottom: 15px solid #8d95ff;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
        <table id="u_content_image_1" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
         
        </table>
        <table  role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 0px;" align="left">    
          <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
            <tbody>
              <tr style="vertical-align: top">
                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                  <span>&#160;</span>
                </td>
              </tr>
            </tbody>
          </table>
              </td>
            </tr>
          </tbody>
        </table>
        <table id="u_content_text_2" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 40px 10px;" align="left">      
          <div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
            </span><h2>DE: Malusa Coffee</h2><br/><br><h3>Si usted no ha requerido un cambio de password desestime este mensaje.</h3><br/>
          </div>
              </td>
            </tr>
          </tbody>
        </table>
        <table id="u_content_button_1" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 10px 40px;;" align="left">
        <div align="left">
            <a href="http://localhost/carrito/login/nueva.php?id='.$id.'"target="_blank" class="v-button v-size-width" style="box-sizing: border-box;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #000000; background-color: #ffc25e; border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; width:42%; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;font-size: 14px;">
              </span>Haga click aqui </br> para recuperar su password</span>
            </a>
        </div><br /><br /><strong>Reference: Malusa Coffee</p>
              </td>
            </tr>
          </tbody>
        </table>
          </div>
        </body>
        </html>';
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }    
        }
    }
}else{
    echo 'error';
}
?>
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
		      	<h3 class="mb-4 text-center">Restablecer contraseña</h3>
				<br>
				<form action="recuperar.php" method="post">
				<div class="form-group">
		      			<input type="text" name="correo" id="correo" class="form-control" placeholder="Correo  electronico" required>
		      		</div><br>
	            <div class="form-group">
	            	<button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Restablecer</button>
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

