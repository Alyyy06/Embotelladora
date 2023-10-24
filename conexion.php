<?php 

$user="root";
$clave="";
$host="localhost";
$db="botellones";

$conn=mysqli_connect($host,$user,$clave,$db);

if(!$conn){
    echo "error ".mysqli_connect_error();}
?>