<?php
    $correo = $_POST["txtCorreo"];
    $nombre = $_POST["txtNombre"];
    $rfc = $_POST["txtRFC"];
    $ciudad = $_POST["txtCiudad"];
    $delegacion = $_POST["txtDelegacion"];
    $cp = $_POST["txtCP"];
    $calle = $_POST["txtCalle"];
    $telefono = $_POST["txtNumero"];
    $extencion = $_POST["txtExt"];
    $contrasena = md5($_POST["txtContrasena"]);

    $respAX_JSON = array();
    $conexion = mysqli_connect("localhost","root","","usuarios");
    $sql = "INSERT INTO organizaciones (TIPO_ORGANIZACION,RFC, NOMBRE_CENTRO, CORREO_ELECTRONICO, CIUDAD, DELEGACIÓN, CP, CALLE,TELEFONO,EXTENSION,CONTRASENA) VALUES ('1', '$rfc', '$nombre', '$correo', '$ciudad', '$delegacion', '$cp', '$calle', '$telefono', '$extencion', '$contrasena')";
    $sqlCheckCorreo = "SELECT * FROM organizaciones WHERE CORREO_ELECTRONICO = '$correo'";
    $resultadoCheckCorreo = mysqli_query($conexion,$sqlCheckCorreo);
    
    if(mysqli_num_rows($resultadoCheckCorreo) == 1){
        $respAX_JSON["codigo"]= 2;
        $respAX_JSON["msj"] = "<h3>Error, correo ya registrado, favor de intentarlo de nuevo :c </h3>";
    } else{
        $resultado = mysqli_query($conexion,$sql);
        if(mysqli_affected_rows($conexion) == 1 ){
            $respAX_JSON["codigo"]= 1;
            $respAX_JSON["msj"] = "<h3>Gracias. Tu registro se realizó correctamente </h3>";
        } else{
            $respAX_JSON["codigo"]= 0;
            $respAX_JSON["msj"] = "<h3>Error, favor de intentarlo de nuevo :c </h3>";
        }
    }
    echo json_encode($respAX_JSON);
?>