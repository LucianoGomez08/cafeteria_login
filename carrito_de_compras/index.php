<?php include('carrito.php');?>


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
                <a class="nav-item nav-link active" href="../menu.php" aria-current="page">Home<span class="visually-hidden">Administrador</span></a>
                <a class="nav-item nav-link">Carrito (<?php
                    echo(empty($_SESSION['carrito']))?0:count($_SESSION['carrito']);
                    ?>)</a>
            </div>
        </nav>
  </header>
<br/>
<body>
<main class="container">
    
        <h3>Lista del carito</h3>
            <div class="table-responsive">
            <?php if(!empty($_SESSION['carrito'])){ ?>
                <table class="table table-light table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Descripción</th>
                            <th width="15%" class="text-center">Cantidad</th>
                            <th width="20%" class="text-center">Precio</th>
                            <th width="20%" class="text-center">Total</th>
                            <th width="5%">Acción</th>
                        </tr>    
                        <?php $total=0;?>
                        <?php foreach($_SESSION['carrito'] as $indice=>$registros){?>
                        <tr>
                            <td width="40%"><?php echo $registros['titulo'];?></td>
                            <td width="15%" class="text-center"><?php echo $registros['cantidad'];?></td>
                            <td width="20%" class="text-center">$<?php echo $registros['precio'];?></td>
                            <td width="20%" class="text-center">$<?php echo number_format($registros['precio']*$registros['cantidad'],2);?></td>
                            <td width="5%">
                            <form action="" method="post">

                                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($registros['id'], COD, KEY);?>">

                                <button class="btn btn-danger" 
                                type="submit"
                                name="btnAccion"
                                value="Eliminar">
                                Eliminar</td>
                            </form>

                        </tr>      
                        <?php $total=$total+($registros['precio']*$registros['cantidad'])?>
                        <?php }?>
                        <tr>
                            <td colspan="3" align="right"><h3>TOTAL A PAGAR:</h3></td>
                            <td align="right"><h3>$ <?php echo number_format($total,2);?></h3></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5" >
                                <form action="pagar.php" method="post">
                                    <div class="alert alert-primary" role="alert">
                                        <strong>Correo de contacto</strong>
                                        <input id="email" name="email" class="form-control" type="email" placeholder="Por favor escribe tu correo" required>
                                        <small id="emailhelp" class="form-text text-muted">Los productos se enviarán a este correo</small>
                                    </div>
                                    <button class="btn btn-primary btn-lg" type="submit"
                                    name="btnAccion"
                                    value="proceder"
                                    >Procceder a pagar >></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php }else{?>
                    <div class="alert alert-success">
                        No hay productos en el carrito...
                    </div>
                <?php }?>
            </div>
        
</body>
</html>