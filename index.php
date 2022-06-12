<?php
    session_start();
    $sesion = isset($_SESSION["login"]);

    $conexion = mysqli_connect("localhost","root","","usuarios");
    mysqli_set_charset($conexion,"utf8");

    $infUsuario;

    if($sesion == 1){
      $correo = $_SESSION["login"];
      $sqlUsuario = "SELECT * FROM organizaciones WHERE CORREO_ELECTRONICO = '$correo'";
      $resUsuario = mysqli_query($conexion,$sqlUsuario);
      $infUsuario = mysqli_fetch_row($resUsuario);
    
      $tipoUsuario = $infUsuario[0];
    } else {
      $tipoUsuario = 2;
    }

    ////visualización de registros como card
    $sqlOrganizacionesCard = "SELECT * FROM organizaciones WHERE TIPO_ORGANIZACION = '1'";
    $resOrganizacionesCard = mysqli_query($conexion,$sqlOrganizacionesCard);
    $trOrganizacionesCard = "";
    $i = 1;
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
        $i++;
        if($i >3) break;
    }


    $sqlInventario0 = "SELECT * FROM productos WHERE ID_O = '1'";
    $resInventario0 = mysqli_query($conexion,$sqlInventario0);
    $trInventario0 = "";
    while($filas=mysqli_fetch_array($resInventario0,2)){
        $trInventario0 .= 
            "<tr><td>$filas[2]</td>
            <td>$filas[3]</td>
            <td>$filas[5]</td>
            <td>$filas[6]</td>
            <td>";
        if($sesion)
            $trInventario0.="<i class='btn brown fas fa-cart-plus addCarrito' data-usr='$infUsuario[1]' data-prod='$filas[1]'></i>";
        else
            $trInventario0.="<a class='btn brown' href='./pages/login.html'><i class='fas fa-cart-plus'></i></a>";
                
        $trInventario0 .="</td>
        </tr>";
    }

    $sqlTienda0 = "SELECT * FROM organizaciones WHERE ID_O = '1'";
    $resTienda0 = mysqli_query($conexion,$sqlTienda0);
    $infTienda0 = mysqli_fetch_row($resTienda0);
    $trTienda0 = "<h2>$infTienda0[3]</h2>";
    /////////////////////////////////////////////////////
    $sqlInventario1 = "SELECT * FROM productos WHERE ID_O = '2'";
    $resInventario1 = mysqli_query($conexion,$sqlInventario1);
    $trInventario1 = "";
    while($filas=mysqli_fetch_array($resInventario1,2)){
        $trInventario1 .= 
            "<tr><td>$filas[2]</td>
            <td>$filas[3]</td>
            <td>$filas[5]</td>
            <td>$filas[6]</td>
            <td>";
        if($sesion)
            $trInventario1.="<i class='btn brown fas fa-cart-plus addCarrito' data-usr='$infUsuario[1]' data-prod='$filas[1]'></i>";
        else
            $trInventario1.="<a class='btn brown' href='./pages/login.html'><i class='fas fa-cart-plus'></i></a>";
                
        $trInventario1 .="</td>
        </tr>";
    }

    $sqlTienda1 = "SELECT * FROM organizaciones WHERE ID_O = '2'";
    $resTienda1 = mysqli_query($conexion,$sqlTienda1);
    $infTienda1 = mysqli_fetch_row($resTienda1);
    $trTienda1 = "<h2>$infTienda1[3]</h2>";
    ///////////////////////////////////////////////////
    $sqlInventario2 = "SELECT * FROM productos WHERE ID_O = '3'";
    $resInventario2 = mysqli_query($conexion,$sqlInventario2);
    $trInventario2 = "";
    while($filas=mysqli_fetch_array($resInventario2,2)){
        $trInventario2 .= 
            "<tr><td>$filas[2]</td>
            <td>$filas[3]</td>
            <td>$filas[5]</td>
            <td>$filas[6]</td>
            <td>";
        if($sesion)
            $trInventario2.="<i class='btn brown fas fa-cart-plus addCarrito' data-usr='$infUsuario[1]' data-prod='$filas[1]'></i>";
        else
            $trInventario2.="<a class='btn brown' href='./pages/login.html'><i class='fas fa-cart-plus'></i></a>";
                
        $trInventario2 .="</td>
        </tr>";
    }

    $sqlTienda2 = "SELECT * FROM organizaciones WHERE ID_O = '3'";
    $resTienda2 = mysqli_query($conexion,$sqlTienda2);
    $infTienda2 = mysqli_fetch_row($resTienda2);
    $trTienda2 = "<h2>$infTienda2[3]</h2>";

    ///////////////////////////////////////////////////////////////
    $sqlInventario3 = "SELECT * FROM productos WHERE ID_O = '4'";
    $resInventario3 = mysqli_query($conexion,$sqlInventario3);
    $trInventario3 = "";
    while($filas=mysqli_fetch_array($resInventario3,2)){
        $trInventario3 .= 
            "<tr><td>$filas[2]</td>
            <td>$filas[3]</td>
            <td>$filas[5]</td>
            <td>$filas[6]</td>
            <td>";
        if($sesion)
            $trInventario3.="<i class='btn brown fas fa-cart-plus addCarrito' data-usr='$infUsuario[1]' data-prod='$filas[1]'></i>";
        else
            $trInventario3.="<a class='btn brown' href='./pages/login.html'><i class='fas fa-cart-plus'></i></a>";
                
        $trInventario3 .="</td>
        </tr>";
    }

    $sqlTienda3 = "SELECT * FROM organizaciones WHERE ID_O = '4'";
    $resTienda3 = mysqli_query($conexion,$sqlTienda3);
    $infTienda3 = mysqli_fetch_row($resTienda3);
    $trTienda3 = "<h2>$infTienda3[3]</h2>";

    ///////////////////////////////////////////////////////////////
    $sqlInventario4 = "SELECT * FROM productos WHERE ID_O = '5'";
    $resInventario4 = mysqli_query($conexion,$sqlInventario4);
    $trInventario4 = "";
    while($filas=mysqli_fetch_array($resInventario4,2)){
        $trInventario4 .= 
            "<tr><td>$filas[2]</td>
            <td>$filas[3]</td>
            <td>$filas[5]</td>
            <td>$filas[6]</td>
            <td>";
        if($sesion)
            $trInventario4.="<i class='btn brown fas fa-cart-plus addCarrito' data-usr='$infUsuario[1]' data-prod='$filas[1]'></i>";
        else
            $trInventario4.="<a class='btn brown' href='./pages/login.html'><i class='fas fa-cart-plus'></i></a>";
                
        $trInventario4 .="</td>
        </tr>";
    }

    $sqlTienda4 = "SELECT * FROM organizaciones WHERE ID_O = '5'";
    $resTienda4 = mysqli_query($conexion,$sqlTienda4);
    $infTienda4 = mysqli_fetch_row($resTienda4);
    $trTienda4 = "<h2>$infTienda4[3]</h2>";

    ///////////////////////////////////////////////////////////////
    $sqlInventario5 = "SELECT * FROM productos WHERE ID_O = '6'";
    $resInventario5 = mysqli_query($conexion,$sqlInventario5);
    $trInventario5 = "";
    while($filas=mysqli_fetch_array($resInventario5,2)){
        $trInventario5 .= 
            "<tr><td>$filas[2]</td>
            <td>$filas[3]</td>
            <td>$filas[5]</td>
            <td>$filas[6]</td>
            <td>";
        if($sesion)
            $trInventario5.="<i class='btn brown fas fa-cart-plus addCarrito' data-usr='$infUsuario[1]' data-prod='$filas[1]'></i>";
        else
            $trInventario5.="<a class='btn brown' href='./pages/login.html'><i class='fas fa-cart-plus'></i></a>";
                
        $trInventario5 .="</td>
        </tr>";
    }

    $sqlTienda5 = "SELECT * FROM organizaciones WHERE ID_O = '6'";
    $resTienda5 = mysqli_query($conexion,$sqlTienda5);
    $infTienda5 = mysqli_fetch_row($resTienda5);
    $trTienda5 = "<h2>$infTienda5[3]</h2>";

    ///////////////////////////////////////////////////////////////
?>

<!--INICIO HTML-->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Store</title>
    <link rel="icon" type="image/x-icon" href="./rsc/favicon.ico">
    <!--CSS-->
    <link rel="stylesheet" href="./css/index.css">
    <link href="./js/plugins/validetta101/validetta.min.css" rel="stylesheet">
    <link href="./js/plugins/confirm334/jquery-confirm.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--js-->
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/plugins/validetta101/validetta.min.js"></script>
    <script src="./js/plugins/validetta101/validettaLang-es-ES.js"></script>
    <script src="./js/plugins/confirm334/jquery-confirm.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="./js/main.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Helping <img src="./rsc/logo.png" class="img-hm30"> Hands</a>
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
                        <a class='nav-link text-light black-bold' href='./pages/carrito.php'><i class='fa-solid fa-cart-shopping'></i> Carrito</a>
                    </li>";?>
                    <li class="nav-item">
                        <a class="nav-link text-dark grey-bold" href='<?php if($sesion) echo "./pages/pagusuario.php"; else echo "./pages/login.html";?>'> <i
                                class="fa-solid fa-user"></i> <?php if($sesion) echo "Página de usuario"; else echo "Iniciar sesión";?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark grey-bold" href='<?php if($sesion) echo "./pages/logout.php"; else echo "./pages/registro.html";?>'> <?php if($sesion) echo "Cerrar sesión"; else echo "Registrarse";?></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <main>
        <div class="main-rect text-white">
            <div class="rect">¡Encuentra a <b>tu aliado</b> para apoyar!</div>
        </div>
        <div class="main-cont">
            <div class="tienda">
                <h1 style="margin-top: 3vh;">TIENDAS DISPONIBLES</h1>
                <hr size="8px" color="black" />
                <div class="cardContainer">
                    <?php echo $trOrganizacionesCard;?>
                    <div class="foot" id="foot">
                        <a href="./pages/tiendas.php" class="text-center text-light btn-bold">Ver todas las tiendas <br> <i class="fa-solid fa-circle-arrow-right"></i></a>
                    </div> 
                </div>

                <h1 style="margin-top: 5vh;">ALGUNOS PRODUCTOS DISPONIBLES</h1>
                <hr size="8px" color="black" />
                <div class="title align-items-end">
                    <?php echo $trTienda0;?>
                </div>
                <div class="table-responsive">
                <table class="table">
                    <thead class= "rwd_auto fontsize">
                        <tr><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Fecha de caducidad</th><th scope="col">Cantidad</th></tr>
                    </thead>
                    <tbody>
                        <?php echo $trInventario0;?>
                    </tbody>
                </table>
                </div>

                <br>
                <div class="title align-items-end">
                    <?php echo $trTienda1;?>
                </div>
                <div class="table-responsive">
                <table class="table">
                    <thead class= "rwd_auto fontsize">
                        <tr><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Fecha de caducidad</th><th scope="col">Cantidad</th></tr>
                    </thead>
                    <tbody>
                        <?php echo $trInventario1;?>
                    </tbody>
                </table>
                </div>
                
                <br>
                <div class="title align-items-end">
                    <?php echo $trTienda2?>
                </div>
                <div class="table-responsive">
                <table class="table">
                    <thead class= "rwd_auto fontsize">
                        <tr><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Fecha de caducidad</th><th scope="col">Cantidad</th></tr>
                    </thead>
                    <tbody>
                        <?php echo $trInventario2;?>
                    </tbody>
                </table>
                </div>

                <br>

                <div class="title align-items-end">
                    <?php echo $trTienda3;?>
                </div>
                <div class="table-responsive">
                <table class="table">
                    <thead class= "rwd_auto fontsize">
                        <tr><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Fecha de caducidad</th><th scope="col">Cantidad</th></tr>
                    </thead>
                    <tbody>
                        <?php echo $trInventario3;?>
                    </tbody>
                </table>
                </div>
                
                <br>

                <div class="title align-items-end">
                    <?php echo $trTienda4;?>
                </div>
                <div class="table-responsive">
                <table class="table">
                    <thead class= "rwd_auto fontsize">
                        <tr><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Fecha de caducidad</th><th scope="col">Cantidad</th></tr>
                    </thead>
                    <tbody>
                        <?php echo $trInventario4;?>
                    </tbody>
                </table>
                </div>
                
                
                <br>

                <div class="title align-items-end">
                    <?php echo $trTienda5;?>
                </div>
                <div class="table-responsive">
                <table class="table">
                    <thead class= "rwd_auto fontsize">
                        <tr><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Fecha de caducidad</th><th scope="col">Cantidad</th><th scope="col">&nbsp;</th></tr>
                    </thead>
                    <tbody>
                        <?php echo $trInventario5;?>
                    </tbody>
                </table>
                </div>
                
                <br>
            </div>           
        </div>

        
    </main>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>