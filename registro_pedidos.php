<?php
include("conexion.php");

$Rif = $_POST['rif'];
$Cantidad = $_POST['Cantidad'];

$busqueda =  mysqli_query($conn,"SELECT id FROM cliente WHERE rif='".$Rif."'") or die(mysqli_error($conn));

$vID=0;

if(is_numeric($Rif) && is_numeric($Cantidad)){
  if(mysqli_num_rows($busqueda)==1){
    while($row = mysqli_fetch_array($busqueda)){
      $vID =$row[0];
      echo $vID;
      $insert=mysqli_query($conn,"INSERT INTO pedidos(Fecha_llenado, CantidadBote, id_Clientes) VALUES(now(),'".$Cantidad."','".$vID."')");
      echo "Pedido Registrado exitosamente";
    }
  }else{echo"El Rif colocado no esta asignado a ningun cliente registrado!";}
}else{echo"Los dos campos deben ser numericos";}
/*
if(is_numeric($Rif)){
    if(){





    }else{}
}else{echo "el rif esta escrito incorrectamente";}

*/

?>