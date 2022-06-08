<?php
    session_start();
    $sesion = isset($_SESSION["login"]);

    $conexion = mysqli_connect("localhost","root","","usuarios");
    mysqli_set_charset($conexion,"utf8");

    $infUsuario;

    if($sesion == 1){
      $correo = $_SESSION["login"];
      $sqlUsuario = "SELECT * FROM usuarios WHERE correo = '$correo'";
      $resUsuario = mysqli_query($conexion,$sqlUsuario);
      $infUsuario = mysqli_fetch_row($resUsuario);
    
      $tipoUsuario = $infUsuario[5];
    } else {
      $tipoUsuario = 2;
    }

    ////Numero de registros
    $sqlNumOrg = "SELECT COUNT(*) FROM organizaciones WHERE TIPO_ORGANIZACION='1'";
    $resNumOrg = mysqli_query($conexion,$sqlNumOrg);
    $numOrg =  mysqli_fetch_row($resNumOrg);
    $trNumOrg = $numOrg[0];

    ////visualización de registros como card
    $sqlOrganizacionesCard = "SELECT * FROM organizaciones WHERE TIPO_ORGANIZACION = '1'";
    $resOrganizacionesCard = mysqli_query($conexion,$sqlOrganizacionesCard);
    $trOrganizacionesCard = "";
    while($filasCard = mysqli_fetch_array($resOrganizacionesCard,2)){
        if($filasCard[10] == NULL) $fila10 = "";
        else $fila10 = "($filasCard[10])";
        $trOrganizacionesCard .= 
            "<div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>$filasCard[3]</h5>
                    <p class='card-text'><b>Ubicación:</b> $filasCard[8] <br> <b>Contacto:</b> $filasCard[9] $fila10 </p>
                    <a href='#' class='card-link'>Ver Productos</a>
                </div>
            </div>
            ";
    }
    
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helping Hands</title>
    <link rel="icon" type="image/x-icon" href="./../rsc/favicon.ico">
    <!--CSS-->
    <link rel="stylesheet" href="./../css/index.css">
    <link rel="stylesheet" href="./../css/tiendas.css">
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
    <script src="./../js/index.js"></script>
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
                    <li class="nav-item">
                        <a class="nav-link text-light black-bold" href="#"> <i class="fa-solid fa-cart-shopping"></i>
                            Carrito</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark grey-bold" href="./../pages/login.html"> <i
                                class="fa-solid fa-user"></i> Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark grey-bold" href="./../pages/registro.html">Regístrate</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <main>
        <div class="main-cont">
            <div class="tienda">
                <div class="text-center">
                    <h1 class="text-center" style="text-align: center;"><?php echo $trNumOrg;?> Tiendas disponibles</h1>
                </div>

                <div class="cardContainer">
                    <?php echo $trOrganizacionesCard;?>
                </div>
            </div>           
        </div>

        
    </main>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>