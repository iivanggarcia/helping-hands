<?php
    $conexion = mysqli_connect("localhost","root","","usuarios");
    mysqli_set_charset($conexion,"utf8");

    $sql = "DELETE FROM carrito WHERE ID_O=".$_POST["usuario"]." AND ID_PRODUCTO=".$_POST["producto"];
    $res = mysqli_query($conexion,$sql);

    $respAX = array();
    $mensaje = "";

    if($res==1){
        $respAX["codigo"] = 1;
        $respAX["mensaje"] = "Eliminado del carrito.";
    }else{
        $respAX["codigo"] = 0;
        $respAX["mensaje"] = "Error al eliminar del carrito.";
    }

    echo json_encode($respAX);
?>