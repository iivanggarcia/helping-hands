<?php
    session_start();

    if(isset($_SESSION["login"])){
    
    $sesion = $_SESSION["login"];
    $conexion = mysqli_connect("localhost","root","","usuarios");
    mysqli_set_charset($conexion,"utf8");

    $sqlUsuarioAdmin = "SELECT * FROM organizaciones WHERE CORREO_ELECTRONICO = '$sesion' AND (TIPO_ORGANIZACION = '1')";
    $resUsuarioAdmin = mysqli_query($conexion,$sqlUsuarioAdmin);
    $infoUsuarioAdmin = mysqli_num_rows($resUsuarioAdmin);
    
    if($infoUsuarioAdmin != 1){
        header("location: ./../index.php");
    }else{
        $sqlAlumnos = "SELECT * FROM detalle_pedido WHERE ESTADO = '0'";
        $resAlumnos = mysqli_query($conexion, $sqlAlumnos); 
        
        $trAlumnos = "";
        while($filas = mysqli_fetch_array($resAlumnos, MYSQLI_BOTH)){ 
            $sqlPro = "SELECT * FROM productos WHERE ID_PRODUCTO = '$filas[1]'";
            $resPro = mysqli_query($conexion, $sqlPro); 
            $row = mysqli_fetch_array($resPro, MYSQLI_BOTH);

            $trAlumnos .= "<tr>
                <td>$filas[0]</td>
                <td>$row[2]</td>
                <td>$filas[2]</td>
                <td><a href='completarPedido_AX.php?pedido=$filas[0]&producto=$filas[1]'><i class='fas fa-check-square fa-2x green-text text-darken-3'></i></a></td>
            </tr>";
        }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helping Hands - Pedidos</title>
    <link rel="icon" type="image/x-icon" href="./../rsc/favicon.ico">
    <!--CSS-->
    <link rel="stylesheet" href="./../css/index.css">
    <link href="./../js/plugins/validetta101/validetta.min.css" rel="stylesheet">
    <link href="./../js/plugins/confirm334/jquery-confirm.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--js-->
    <script src="./../js/jquery-3.6.0.min.js"></script>
    <script src="./../js/plugins/validetta101/validetta.min.js"></script>
    <script src="./../js/plugins/validetta101/validettaLang-es-ES.js"></script>
    <script src="./../js/plugins/confirm334/jquery-confirm.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="./../js/pedidos.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="./../index.php">Helping <img src="./../rsc/logo.png" class="img-hm30"> Hands</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex me-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="Enlatados, líquidos, otros"
                        aria-label="Search">
                    <button class="btn btn-outline-dark" type="submit">Buscar</button>
                </form>
                <ul class="navbar-nav me-left mb-2 mb-lg-0">
                    <?php if($sesion) echo "<li class='nav-item'>
                        <a class='nav-link text-light black-bold' href='./../pages/carrito.php'><i class='fa-solid fa-cart-shopping'></i> Carrito</a>
                    </li>";?>
                    <li class="nav-item">
                        <a class="nav-link text-dark grey-bold" href='<?php if($sesion) if($tipoUsuario ==0) echo "./profile-client.php"; else echo "./profile-store.php"; else echo "./login.html";?>'> <i
                                class="fa-solid fa-user"></i> <?php if($sesion) echo "Página de usuario"; else echo "Iniciar sesión";?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark grey-bold" href='<?php if($sesion) echo "./../pages/logout.php"; else echo "./../pages/registro.html";?>'> <?php if($sesion) echo "Cerrar sesión"; else echo "Registrarse";?></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
  <div class="container">
            <div class="row">
            
            <h3 style="text-align:center; padding-top: 15vh">Pedidos</h3>
                <!-- clase de materialize-->
                <table class="centered striped responsive-table">
                    <thead>
                        <!--- los encabezados de la tabla--->
                        <tr><th>Pedido No.</th><th>Productos</th><th>Cantidad</th><th>Marcar Completado</th></tr>
                    </thead>
                    <tbody>
                        <?php echo $trAlumnos; ?>
                    </tbody>
                </table>
            </div>
        </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>

<?php
    }
    }else{
        header("location: ./../index.php");
    }
?>