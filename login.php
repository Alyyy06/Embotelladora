<?php 
include("conexion.php");

$usuario = $_POST["Usuario"];
$clave = $_POST["Clave"];

$busqueda = mysqli_query($conn,"SELECT User FROM usuarios WHERE User ='".$usuario."'and Pass = '".$clave."'") or die(mysqli_error($conn));
$buscando = mysqli_num_rows($busqueda);
if($buscando == 1){
    return $buscando;
}else{echo "No hay usuarios";}



?>