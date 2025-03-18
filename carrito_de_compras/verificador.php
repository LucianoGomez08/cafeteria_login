<?php
include('../admin/bd.php');
include('carrito.php');
//print_r($_GET);

$ClientID="AY3WJ6ikkxI5_GC-RnByH0sYol5jSkB3LV2JgbWezQgL-bXQbqLgeTodrh3MCEJzFQC8oCboI5_wHlvM";
$Secret="EB9cl6i1lZKd2MjHC_vW86WQRp3n8B484pggf3BdQ2_d5SByxuNNA7bh6_Cv6tB_CUper7PuvVCXayLO";

$Login= curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");

curl_setopt($Login, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($Login, CURLOPT_USERPWD,$ClientID.":".$Secret);

curl_setopt($Login, CURLOPT_POSTFIELDS,"grant_type=client_credentials");

$Respuesta=curl_exec($Login);

$objRespuesta=json_decode($Respuesta);

$AccessToken=$objRespuesta->access_token;

$Venta=curl_init("https://api-m.sandbox.paypal.com/v1/payments/payment/".$_GET['paymentID']);

curl_setopt($Venta,CURLOPT_HTTPHEADER,array("Content-Type:application/json","Authorization: Bearer ".$AccessToken));

curl_setopt($Venta, CURLOPT_RETURNTRANSFER, TRUE);

 $RespuestaVenta=curl_exec($Venta);

 //print_r($RespuestaVenta);

 $objDatosTransaccion=json_decode($RespuestaVenta);

//print_r($objDatosTransaccion);

$state=$objDatosTransaccion->state;
$email=$objDatosTransaccion->payer->payer_info->email;

$total=$objDatosTransaccion->transactions[0]->amount->total;
$currency=$objDatosTransaccion->transactions[0]->amount->currency;
$custom=$objDatosTransaccion->transactions[0]->custom;


$clave=explode("#",$custom);

$SID=$clave[0];
$claveVenta=openssl_decrypt($clave[1],COD, KEY);

curl_close($Venta);
curl_close($Login);

if($state=="approved"){
    $mensajePaypal="<h3>Pago aprobado</h3>";

    $sentencia=$conexion->prepare("UPDATE `tbl_ventas` 
            SET `paypalDatos` = :paypalDatos, `status` = 'Aprobado' 
            WHERE `tbl_ventas`.`id` = :id;");
            
    $sentencia->bindParam(":id", $claveVenta);
    $sentencia->bindParam(":paypalDatos", $RespuestaVenta); 
    $sentencia->execute();

    $sentencia=$conexion->prepare("UPDATE `tbl_ventas` 
            SET status='Completo'
            WHERE `claveTransaccion`=:claveTransaccion
            AND `total`=:total
            AND `id`=:id");

$sentencia->bindParam(":claveTransaccion", $SID);
$sentencia->bindParam(":total", $total);
$sentencia->bindParam(":id", $claveVenta);
$sentencia->execute();


}else{
    $mensajePaypal="<h3>Pago no aprobado</h3>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <style>
        body {
            background-image: url('../img/fotos/11.jpg');
            background-size: cover;
            background-position: center;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 115vh;
            padding: 0;
        }
        .display-4 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            height: 15vh
        }
      
       
    </style>
</head>
<body>
<header>
    <!-- place navbar here -->
        <nav class="navbar navbar-expand navbar-light bg-transparent">
            <div class="nav navbar-nav">
               <h3> <a class="nav-item nav-link active" href="../index.php" aria-current="page">Home <span class="visually-hidden">Administrador</span></a></h3>
               <h3> <a class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar sesion</a></h3>
            </div>
        </nav>
  </header>
<br><br><br><br><br><br><br><br>
<div class="container">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-4 fw-bold text-center text-white">¡ LISTO !  PAGO APROBADO !!</h1>
            <a class="btn btn-primary  fw-bold text-center" href="descargar.php">Ver factura </a>
        </div>
</div>
</div>
</body>
</html>