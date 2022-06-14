<?php
    session_start();

    $ver = 1;
    $pedido = $_GET["pedido"];
    $producto = $_GET["producto"];

    $conexion = mysqli_connect("localhost","root","","usuarios");
    mysqli_set_charset($conexion,"utf8");

    $correoAdmin = $_SESSION["login"];
    
    date_default_timezone_set('America/Mexico_City');
    $hoy = date("Y-m-d");

    $sqlAdmin = "SELECT * FROM organizaciones WHERE CORREO_ELECTRONICO = '$correoAdmin'";
    $resAdmin = mysqli_query($conexion, $sqlAdmin);
    $infAdmin = mysqli_fetch_row($resAdmin);

    $sqlCheckPedido = "SELECT * FROM detalle_pedido WHERE ID_PEDIDO = '$pedido' AND ID_PRODUCTO = '$producto'";
    $resultadoCheckPedido = mysqli_query($conexion,$sqlCheckPedido);
    $infPedido = mysqli_fetch_row($resultadoCheckPedido);

    $sqlCheckOrganizacion = "SELECT * FROM organizaciones WHERE ID_O = '$infPedido[3]'";
    $resultadoCheckOrganizacion = mysqli_query($conexion,$sqlCheckOrganizacion);
    $infOrganizacion = mysqli_fetch_row($resultadoCheckOrganizacion);

    $sqlCheckProd = "SELECT * FROM productos WHERE ID_PRODUCTO = '$producto'";
    $resultadoCheckProd = mysqli_query($conexion,$sqlCheckProd);
    $infProd = mysqli_fetch_row($resultadoCheckProd);

    $sql = "UPDATE `detalle_pedido` SET ESTADO = '1' WHERE ID_PEDIDO = '$pedido' AND ID_PRODUCTO = '$producto'";
    $resultado = mysqli_query($conexion,$sql);

    
    
    //Prepar mi 'página HTML' que se convertirá a PDF, considerando las limitaciones en cuanto soporte de etiquetas HTML y propiedades CSS que ofrece la clase mPDF
    $html = '
    <style>
    .resaltar{
        color:#ffecb3;
        font-family:"Verdana";
        font-weight: bold;
    }
    h1,h2{
        color:#795548  ;
        text-align: center;
        font-family:"Verdana";
        font-weight: bold;
    }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }  
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }     
    tr:nth-child(even) {
        background-color: #dddddd;
    }
    </style>
    <h1><a name="top"></a>ACTA DE ENTREGA DE DONACIONES '.$hoy.'</h1>
    <br><br>
    <b>'.$infOrganizacion[3].'</b> identificado con RFC '.$infOrganizacion[2].' certifica la entrega de los siguientes materiales en calidad de donación.
     <br><br>- '.$infPedido[2].' unidades de '.$infProd[2].'.
     <br><br><br>
    Se hace constar que la presente donación está en buen estado.<br><br>
    Firma a '.$hoy.'';


    require_once('./../vendor/autoload.php');
    $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']); //L para horizontal, P para vertical
    $mpdf->SetWatermarkText("Helping Hands"); //marca de agua
    $mpdf->showWatermarkText = true;

    $mpdf->WriteHTML($html);
    if($ver == 1){
        $mpdf->output(); //para solo mostrar el pdf
    }else{
        $mpdf->Output("./reportes/reporte_$hoy.pdf","F");
        header("location:./profile-store.php");
    }
    exit;
?>