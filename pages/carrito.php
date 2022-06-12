<?php
    session_start();
    $sesion = isset($_SESSION["login"]);

    $conexion = mysqli_connect("localhost","root","","usuarios");
    mysqli_set_charset($conexion,"utf8");

    $infUsuario;

    if($sesion==1){
        //Hay sesión de usuario
        $correo = $_SESSION["login"];
        $sqlUsuario = "SELECT * FROM organizaciones WHERE CORREO_ELECTRONICO = '$correo'";
        $resUsuario = mysqli_query($conexion,$sqlUsuario);
        $infUsuario = mysqli_fetch_row($resUsuario);
        
        $tipoUsuario = $infUsuario[0];

        //Cargar lista del carrito de la BD
        $sqlCarrito = "SELECT productos.NOMBRE_PRODUCTO,carrito.CANTIDAD,carrito.ID_PRODUCTO FROM  productos, carrito WHERE carrito.ID_O=$infUsuario[1] AND productos.ID_PRODUCTO=carrito.ID_PRODUCTO;";
        $resCarrito = mysqli_query($conexion,$sqlCarrito);
        $listaCarrito = "";
        $listaVacia = "";
        $total = 0;
        while($filas=mysqli_fetch_array($resCarrito,2)){
            $listaCarrito .= "<tr>
                <td>$filas[0]</td>
                <td>$filas[1]</td>
                <td><i class='btn brown far fa-trash-alt deleteCarrito' data-usr=$infUsuario[1] data-prod=$filas[2]></i></td>
                </tr>";
            $total += $filas[1];
        }
        if($total==0)
            $listaVacia = "<h4 style='text-align:center'>El carrito está vacío.</h4>";
    }else{
        //No hay sesión de usuario
        header("location: ./login.html");
    }
?>

<!--*****************
    Inicia HTML
******************-->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helping Hands - Carrito</title>
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
    <script src="./../js/carrito.js"></script>
</head>
<body>
  <header>
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
  </header>
  <main>
    <div class="container">
        <div id="title" class="row">
            <h4>Carrito de <?php echo $infUsuario[3]?></h4>
        </div>
        <div id="list" class="row">
            <table class="striped centered responsive-table">
                <thead>
                    <tr><td>Producto</td><td>Cantidad</td><td>Precio</td><td>Acción</td></tr>
                </thead>
                <tbody>
                    <?php if($total>0) echo $listaCarrito?>
                </tbody>
            </table>
            <?php if($total==0) echo $listaVacia?>
        </div>
        <hr>
        <div class="row">
            <h6>
            <div class="col s6 m8" style="text-align: right">Total a pagar:</div>
            <div clas="col s6 m4" style="text-align: center"><b>$ <?php echo $total?></b></div>
            </h6>
        </div>
        <div class="row">
            <h6>
            <div class="col s6 m8" style="text-align: right">Saldo actual:</div>
            <div clas="col s6 m4" style="text-align: center"><b>$ <?php echo $infUsuario[6]?></b></div>
            </h6>
        </div>
        <div class="row">
            <div class="col m6"></div>
            <?php
                if($total>0)
                    if($total<=$infUsuario[6]){
                        //saldo suficiente, pagar
                        echo "<div class='col s12 m6'><a class='btn green pagarProductos' data-usr='$infUsuario[0]' data-total='$total' style='width:100%;'>Pagar</a></div>";
                    }else{
                        //saldo insuficiente, agregar
                        echo "<div class='col s12 m6'><h6 align='center' style='color:red;'>Saldo insuficiente para pagar.</h6></div>";
                    }
            ?>
        </div>
    </div>
  </main>
</body>
</html>