<?php  


    $url_base="http://localhost/FINAL CAFETERIA/admin/";
 
    if(isset($_GET['cerrar_sesion'])){
      session_destroy();
      header("Location: $url_base../index.php");
    }


?>

<!doctype html>
<html lang="es">

<head>
  <title>Administrador del sitio web</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous">
    </script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script type="text/javascript"  charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <header>
    <!-- place navbar here -->

        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="<?php echo $url_base;?>../index.php" aria-current="page">Home <span class="visually-hidden">Administrador</span></a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/nosotros">Nosotros</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/servicios">Servicios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/servicios">Servicios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/menu">Menu</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/reservas">Reservas</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/testimonios">Testimonios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/mensajes">Mensajes</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/configuraciones">Configuraciones</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/usuarios">Usuarios</a>
                
                <a class="nav-item nav-link" href="<?php echo $url_base;?>../index.php">Cerrar sesion</a>
            </div>
        </nav>
  </header>
  <main class="container" >
<br/>

<script>

  <?php if(isset($_GET['mensaje'])){ ?>
  Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});
<?php }?>

</script>