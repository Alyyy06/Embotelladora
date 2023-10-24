<?php
include("conexion.php");

$datos = mysqli_query($conn,"SELECT idP,Fecha_llenado,CantidadBote,rif,zona_pais,id_Clientes FROM pedidos INNER JOIN cliente ON id_clientes=id") or die(mysqli_error($conn));


echo "
    <table class='table table-dark' aling='center'>
        <tr class='d-flex'>
            <th class='col-2'>ID</th>
            <th class='col-2'>Fecha de llenado</th>
            <th class='col-2'>Cantidad</th>
            <th class='col-2'>Rif del cliente</th>
            <th class='col-2'>Zona</th>
        </tr>
";
while ($row = mysqli_fetch_array($datos)){
    echo "<tr class='d-flex'>";
    echo "<td class='col-2'>".$row["idP"]."</td>";
    echo "<td class='col-2'>".$row["Fecha_llenado"]."</td>";
    echo "<td class='col-2'>".$row["CantidadBote"]."</td>";
    echo "<td class='col-2'>".$row["rif"]."</td>";
    echo "<td class='col-2'>".$row["zona_pais"]."</td>";
    echo"</tr>";
}

echo "</table>";
?>