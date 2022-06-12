<?php
    $conexion = mysqli_connect("localhost","root","","usuarios");
    mysqli_set_charset($conexion,"utf8");

    $sql = "SELECT * FROM carrito WHERE ID_O=".$_POST["usuario"]." AND ID_PRODUCTO=".$_POST["producto"];
    $res = mysqli_query($conexion,$sql);
    $cols = mysqli_num_rows($res);

    $respAX = array();
    $mensaje = "";

    if($cols==1){
        //Update
        $sql2 = "UPDATE carrito SET CANTIDAD = CANTIDAD+1 WHERE (ID_PRODUCTO =".$_POST["producto"].")";
        $res2 = mysqli_query($conexion,$sql2);

        $respAX["codigo"] = 1;
        $respAX["mensaje"] = "Agregado al carrito.";
    }else{
        //Insert
        $sql2 = "INSERT INTO carrito VALUES (".$_POST["usuario"].",".$_POST["producto"].",1);";
        $res2 = mysqli_query($conexion,$sql2);

        $respAX["codigo"] = 1;
        $respAX["mensaje"] = "Agregado al carrito.";
    }

    echo json_encode($respAX);
?>