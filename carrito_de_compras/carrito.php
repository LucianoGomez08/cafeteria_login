<?php include('config.php');
session_start();
$mensaje="";

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){

        case 'Agregar':

            if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
                $id=openssl_decrypt($_POST['id'], COD, KEY);
                $mensaje.="id correcto ". $id;
            }else{
                $mensaje.="Upss... ID incorrecto";
            }
            
            if(is_string(openssl_decrypt($_POST['titulo'], COD, KEY))){
                $titulo=openssl_decrypt($_POST['titulo'], COD, KEY);
                $mensaje.="titulo es correcto ". $titulo;
            }else{
                $mensaje.="Upss... titulo incorrecto";
            }
            
            
            if(is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))){
                $cantidad=openssl_decrypt($_POST['cantidad'], COD, KEY);
                $mensaje.="cantidad correcta ". $cantidad;
            }else{
                $mensaje.="Upss... cantidad incorrecta";
            }
            if(is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))){
                $precio=openssl_decrypt($_POST['precio'], COD, KEY);
                $mensaje.="precio correcto ". $precio;
            }else{
                $mensaje.="Upss... precio incorrecto";
            }

            if(!isset($_SESSION['carrito'])){
                $producto=array(
                    'id'=>$id,
                    'titulo'=>$titulo,
                    'cantidad'=>$cantidad,
                    'precio'=>$precio
                );
                $_SESSION['carrito'][0]=$producto;
                $mensaje= "Producto agregado al carrrito!";
            }else{
                $idProductos=array_column($_SESSION['carrito'],'id');
                if(in_array($id, $idProductos)){
                    if(isset($_SESSION['logueado'])){
                    echo "<script>alert('El producto ya ha sido seleccionado');</script>";
                }
                }else{
                $numeroProductos=count($_SESSION['carrito']);
                $producto=array(
                    'id'=>$id,
                    'titulo'=>$titulo,
                    'cantidad'=>$cantidad,
                    'precio'=>$precio
                );
                $_SESSION['carrito'][$numeroProductos]=$producto;
                $mensaje= "Producto agregado al carrrito!";
            }
        }
            
            break;

        case "Eliminar":

            if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
                $id=openssl_decrypt($_POST['id'], COD, KEY);
               
                foreach($_SESSION['carrito'] as $indice=>$producto){
                    if($producto['id']==$id){
                        unset($_SESSION['carrito'][$indice]);
                      }
                }
            }else{
                $mensaje.="Upss... ID incorrecto";
            }


        break;

    }
}
