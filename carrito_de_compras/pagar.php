<?php
include('../admin/bd.php');
include('carrito.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
        crossorigin="anonymous">
    </script> 

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script type="text/javascript"  charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<header>
    <!-- place navbar here -->

        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="../index.php" aria-current="page">Home <span class="visually-hidden">Administrador</span></a>
                <a class="nav-item nav-link" href="index.php">Carrito (<?php
                    echo(empty($_SESSION['carrito']))?0:count($_SESSION['carrito']);
                    ?>)</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar sesion</a>
            </div>
        </nav>
  </header>
  <main class="container">
<br/>
<?php
if($_POST){
    $total=0;
    $SID=session_id();
    $correo=$_POST['email'];

    foreach($_SESSION['carrito'] as $indice=>$registro){
        $total=$total+($registro['precio']*$registro['cantidad']);
    }

        $sentencia= $conexion->prepare("INSERT INTO `tbl_ventas` 
                         (`id`, `claveTransaccion`, `paypalDatos`, `fecha`, `correo`, `total`, `status`) 
                         VALUES (NULL, :claveTransaccion, '', NOW(), :correo, :total, 'pendiente');");
    
    $sentencia->bindParam(":claveTransaccion", $SID);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":total", $total); 
    $sentencia->execute();
    $idVentas=$conexion->lastInsertId();

   

//

    foreach($_SESSION['carrito'] as $indice=>$registro){

        $sentencia=$conexion->prepare("INSERT INTO `tbl_detalledeventas` 
        (`id`, `id_venta`, `id_producto`, `precio_unitario`, `cantidad`) 
        VALUES (NULL, :id_venta, :id_producto, :precio_unitario, :cantidad)");

        $sentencia->bindParam(":id_venta",$idVentas);
        $sentencia->bindParam(":id_producto",$registro['id']);
        $sentencia->bindParam(":precio_unitario",$registro['precio']);
        $sentencia->bindParam(":cantidad",$registro['cantidad']);
        $sentencia->execute();
        $precio_unitario=$registro['precio'];
        $cantidad=$registro['cantidad'];
        $a=$registro['cantidad'];




//tbl_facturas
     
            $sentencia = $conexion->prepare("SELECT p.titulo AS 'nombre_producto'
            FROM tbl_menu p
            JOIN TBL_detalledeventas d ON p.id = d.id_producto
            WHERE d.id_venta = :id_venta");
            $sentencia->bindParam(':id_venta', $idVentas);
            $sentencia->execute();

            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultado as $producto) {
            $nombre_producto = $producto['nombre_producto'];
            }

        
         $sentencia= $conexion->prepare("INSERT INTO `tbl_facturas` 
         (`id_venta`,`correo`, `total`, `precio_unitario`,`nombre_producto`, `cantidad`) 
         VALUES (:id_venta,:correo, :total, :precio_unitario,:nombre_producto, :cantidad);");
    
        $sentencia->bindParam(":id_venta", $idVentas);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":total", $total); 
        $sentencia->bindParam(":precio_unitario", $precio_unitario); 
        $sentencia->bindParam(":cantidad", $cantidad);
        $sentencia->bindParam(":nombre_producto", $nombre_producto);
        $sentencia->execute();
        $factura=$conexion->lastInsertId();
        
        
        
    }
     
}

?>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<style>

    /*Media query for mobile viewport*/
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }

    /*Media query desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }

</style>

<div class="p-5 mb-4 bg-light rounded-3 text-center">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Paso final!</h1>
        <p class="lead text-center">
        Estas a punto de pagar con Paypal la cantidad de:
        <h4>$<?php echo number_format($total,2); ?></h4></p>
        
        <div id="paypal-button-container"></div>

        <p>Los productos podrán ser descargados una vez que se procese el pago</p>
        <strong>(Por dudas o consultas: lostreschiflados@gmail.com)</strong>
        </p>
    </div>
</div>



<script>
    paypal.Button.render({
        env: 'sandbox',         //sandbox 
         style: {
            label: 'checkout',
            size: 'responsive',
            shape: 'pill',
            color: 'gold'
        },

        client: {
            sandbox:    'AY3WJ6ikkxI5_GC-RnByH0sYol5jSkB3LV2JgbWezQgL-bXQbqLgeTodrh3MCEJzFQC8oCboI5_wHlvM',
            producttion:  '<Ac1XY-SIizJ0a_leHJ8wpXRnDAc2dWz0nmDU9iAo Rp10_NuNS6rmv5-oqaoZLi3fqWBQlV0fv0i3F1eX>'
        },

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $total;?>', currency: 'USD'},
                            custom:"<?php echo $SID;?>#<?php echo openssl_encrypt($idVentas,COD,KEY);?>",
                        }
                    ]  
                }
            });
        },
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(){
                console.log(data);
                window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
            });
        }
    }, '#paypal-button-container');

    </script>
