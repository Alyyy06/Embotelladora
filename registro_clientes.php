<?php
include("conexion.php");

function solo_letras($cadena){
    $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";
    for ($i=0; $i<strlen($cadena); $i++){
    if (strpos($permitidos, substr($cadena,$i,1))===false){return false;}
    } 
    return true;
}

$name=$_POST['Nombre'];
$rif = $_POST['rif'];
$zona = $_POST['zona'];

$buscadato=mysqli_query($conn,"SELECT * FROM cliente WHERE rif = '".$rif."'");

if(is_numeric($rif)){
    if(mysqli_num_rows($buscadato)== 0){
        if(strlen($rif)==11){
            if(solo_letras($name)){
                $insertardatos=mysqli_query($conn,"INSERT INTO cliente(Nombre,rif,zona_pais)VALUES('$name','$rif','$zona')");
                echo"Registro Exitoso!";
            }else{echo"El nombre no puede tener valores numericos";}
        }else{echo "El rif no es valido";}
    }else{echo "No puede registrar 2 clientes con el mismo rif";}
}else{echo "El rif tiene que ser un valor numerico";}
?>