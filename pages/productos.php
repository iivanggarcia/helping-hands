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
    
    $sqlInventario0 = "SELECT * FROM productos WHERE ID_O=".$_GET["idO"];
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

    $sqlTienda0 = "SELECT * FROM organizaciones WHERE ID_O=".$_GET["idO"];
    $resTienda0 = mysqli_query($conexion,$sqlTienda0);
    $infTienda0 = mysqli_fetch_row($resTienda0);
    $trTienda0 = "<h2>$infTienda0[3]</h2>";
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
    <link rel="stylesheet" href="./../css/productos.css">
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
    <script src="./../js/productos.js"></script>
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
                        <a class="nav-link text-dark grey-bold" href='<?php if($sesion) echo "./../pages/pagusuario.php"; else echo "./../pages/login.html";?>'> <i
                                class="fa-solid fa-user"></i> <?php if($sesion) echo "Página de usuario"; else echo "Iniciar sesión";?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark grey-bold" href='<?php if($sesion) echo "./../pages/logout.php"; else echo "./../pages/registro.html";?>'> <?php if($sesion) echo "Cerrar sesión"; else echo "Registrarse";?></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <br><br><br><br>
    <div class="cont-table">
        <div class="title align-items-end">
            <?php echo $trTienda0;?>
        </div>
        <br>
        <div class="table-responsive c-table">
            <table class="table">
                <thead class= "rwd_auto fontsize">
                    <tr><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Fecha de caducidad</th><th scope="col">Cantidad</th></tr>
                </thead>
                <tbody>
                    <?php echo $trInventario0;?>
                </tbody>
            </table>
        </div>
        <a href="tiendas.php" class="link-dark">Regresar</a>
    </div>
    

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>