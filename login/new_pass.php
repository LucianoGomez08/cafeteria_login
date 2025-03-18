<?php
include('../admin/bd.php');
$id=$_POST['id'];
$new_password=$_POST['new_password'];

$sentencia= $conexion->prepare("UPDATE `tbl_usuarios` set password = '$new_password' WHERE id = '$id'");
$sentencia->execute();

header('Location:index.php');
?>