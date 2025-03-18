<?php include("admin/bd.php");
      include("carrito_de_compras/carrito.php");

      
//MOSTRAMOS LOS REGISTROS DE NOSOTROS
$sentencia= $conexion->prepare("SELECT * FROM `tbl_nosotros`"); 
$sentencia->execute();
$lista_nosotros=$sentencia->fetchAll(PDO::FETCH_ASSOC);


//MOSTRAMOS LOS REGISTROS DE NOSOTROS
$sentencia= $conexion->prepare("SELECT * FROM `tbl_configuraciones`"); 
$sentencia->execute();
$lista_configuraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);
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
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Nosotros</h1>
           
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                
                <h1 class="display-4"><?php echo $lista_configuraciones[2]['valor'];?></h1>
            </div>
            <div class="row">
            <?php foreach($lista_nosotros as $registros){?>
                <div class="col-lg-8 py-0 py-lg-5">
                    <h1 class="mb-3"><?php echo $registros["titulo"];?></h1>
                    <h5 class="mb-3"><?php echo $registros["subtitulo"];?></h5>
                    <p><?php echo $registros["descripcion"];?></p>
                </div>
                <?php }?>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/about.png" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


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