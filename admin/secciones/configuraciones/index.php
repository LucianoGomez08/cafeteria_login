<?php include("../../bd.php");

if(isset($_GET['txtid'])){
    //Borrar dicho registro con el ID correspondiente
    $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";
    $sentencia= $conexion->prepare("DELETE FROM tbl_configuraciones WHERE id=:id");
    $sentencia->bindParam(":id",$txtid);
    $sentencia->execute();
}

    //SELECCIONAR REGISTROS
    $sentencia= $conexion->prepare("SELECT * FROM `tbl_configuraciones`"); 
    $sentencia->execute();
    $lista_configuraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);


    include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        <!-- se comenta el boton agregar para evitar cambios -->
       <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a> 
    </div>
    <div class="card-body">
        
    <div class="table-responsive">
        <table class="table table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre de la configuracion:</th>
                    <th scope="col">Valor:</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_configuraciones as $registros){?>
                <tr class="">
                    <td><?php echo $registros['id'];?></td>
                    <td><?php echo $registros['nombre'];?></td>
                    <td><?php echo $registros['valor'];?></td>
                    
                    <td>
                        
                        <a name="" id="" class="btn btn-info" href="editar.php?txtid=<?php echo $registros['id']; ?> " role="button" role="button">Editar</a>

                        <!-- Se quita e boton de eliminar para evitar cambios -->
                         <a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $registros['id']; ?> " role="button">Eliminar</a> 
                </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    

    </div>
</div>


<?php include("../../templates/footer.php"); ?>