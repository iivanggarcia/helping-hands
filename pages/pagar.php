<?php
    $conexion = mysqli_connect("localhost","root","","usuarios");
    mysqli_set_charset($conexion,"utf8");

    $sql = "SELECT * FROM carrito WHERE ID_O=".$_POST["usuario"];
    $res = mysqli_query($conexion,$sql);
    $usuario = $_POST["usuario"];

    while($filas=mysqli_fetch_array($res,2)){
        $sql2 = "UPDATE productos SET CANTIDAD = CANTIDAD - '$filas[2]' WHERE (ID_PRODUCTO = '$filas[1]');";
        mysqli_query($conexion,$sql2);
    }

    $sql = "DELETE FROM carrito WHERE ID_O = ".$_POST["usuario"];
    mysqli_query($conexion,$sql);

    echo "Pagado";
?>