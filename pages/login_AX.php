<?php
    session_start();
    $correo = $_POST["txtCorreo"];
    $contrasena = md5($_POST["txtContrasena"]);

    $respAX_JSON = array();
    $conexion = mysqli_connect("localhost","root","","usuarios");
    $sql = "SELECT * FROM organizaciones WHERE CORREO_ELECTRONICO = '$correo' AND CONTRASENA = '$contrasena'";
    $resultado = mysqli_query($conexion,$sql);
    $info = mysqli_num_rows($resultado);
    $usuario = mysqli_fetch_row($resultado);

    if($info == 1){
        $respAX["codigo"] = 1;
        $respAX["msj"] = "<h3 class='center-align'>¡Bienvenido! $usuario[3]</h3>";
        $_SESSION["login"] = $correo; 
    }else{
        $respAX["codigo"] = 0;
        $respAX["msj"] = "<h3 class='center-align'>Error. Favor de intentarlo nuevamente</h3>";
    }

    echo json_encode($respAX);
?>