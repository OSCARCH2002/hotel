<?php include("../../templetes/head.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Restaurant</title>

    <!-- Normalize V8.0.1 -->
    <link rel="stylesheet" href="http://localhost/cafetec/css/normalize.css">

    <!-- MDBootstrap V5 -->
    <link rel="stylesheet" href="http://localhost/cafetec/css/mdb.min.css">

    <!-- Font Awesome V5.15.1 -->
    <link rel="stylesheet" href="http://localhost/cafetec/css/all.css">
    <!-- General Styles -->
    <link rel="stylesheet" href="http://localhost/cafetec/css/style.css">

</head>

<body>
    <!-- Content -->
    <div class="banner">
        <div class="banner-body">
            <h3 class="text-uppercase">Bienvenido a CafeTec</h3>
            <p>Los mejores platillos y la mejor calidad los encuentras en CafeTec</p>
            <a href="../usuario/menu.php" class="btn btn-warning"><i class="fas fa-hamburger fa-fw"></i> &nbsp; Ir al menu</a>
        </div>
    </div>
    <br>
    <br>

    <div class="container container-web-page">
        <h3 class="text-center text-uppercase poppins-regular font-weight-bold">Nuestros servicios</h3>
        <br>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <p class="text-center"><i class="fas fa-shipping-fast fa-5x"></i></p>
                <h5 class="text-center text-uppercase poppins-regular font-weight-bold">Servicio inmediato</h5>
                <p class="text-center">Ofrecemos servicios de calidad, para que te sientas comodo al realizar sus pedidos.</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <p class="text-center"><i class="fas fa-utensils fa-5x"></i></p>
                <h5 class="text-center text-uppercase poppins-regular font-weight-bold">Servicio local</h5>
                <p class="text-center">Puedes almorzar de sus antojos en nuestras instalaciones, con un buen espacio para que se sienta comodo.</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <p class="text-center"><i class="fas fa-home fa-5x"></i>
                </p>
                <h5 class="text-center text-uppercase poppins-regular font-weight-bold">Entrega segura</h5>
                <p class="text-center">Realiza sus pedidos sin problemas, ya que su entrega sera segura</p>
            </div>
        </div>
    </div>

    <hr>

    <div class="container-fluid container-web-page">
        <h3 class="text-center text-uppercase poppins-regular font-weight-bold">Algunos de nuestros platillos</h3>
        <div class="container-cards full-box">

            <div class="card shadow-1-strong">
                <img class="card-img-top" src="../../assets/img/p1.jpg" alt="nombre_platillo">
                <div class="card-body text-center">
                    <h5 class="card-title font-weight-bold">Tacos de chicharrón</h5>
                    <p class="card-text lead"><span class="badge bg-secondary">$15.00 C/U</span></p>
                </div>
                <div class="card-body text-center">
                    &nbsp; &nbsp;
                    <a href="../../pages/usuario/menu.php" class="btn btn-info btn-sm"><i class="fas fa-utensils fa-fw"></i> &nbsp;
                        Más detalles</a>
                </div>
            </div>

            <div class="card shadow-1-strong">
                <img class="card-img-top" src="../../assets/img/p2.jpg" alt="nombre_platillo">
                <div class="card-body text-center">
                    <h5 class="card-title font-weight-bold">Tacos de mole con arroz</h5>
                    <p class="card-text lead"><span class="badge bg-secondary">$15.00 C/U</span></p>
                </div>
                <div class="card-body text-center">
                    &nbsp; &nbsp;
                    <a href="../../pages/usuario/menu.php" class="btn btn-info btn-sm"><i class="fas fa-utensils fa-fw"></i> &nbsp;
                        Más detalles</a>
                </div>
            </div>

            <div class="card shadow-1-strong">
                <img class="card-img-top" src="../../assets/img/p3.jpg" alt="nombre_platillo">
                <div class="card-body text-center">
                    <h5 class="card-title font-weight-bold">Tacos de cecina</h5>
                    <p class="card-text lead"><span class="badge bg-secondary">$15.00 C/U</span></p>
                </div>
                <div class="card-body text-center">
                    &nbsp; &nbsp;
                    <a href="../../pages/usuario/menu.php" class="btn btn-info btn-sm"><i class="fas fa-utensils fa-fw"></i> &nbsp;
                        Más detalles</a>
                </div>
            </div>

        </div>
        <br>
        <p class="text-center"><a href="../usuario/menu.php" class="btn btn-primary"><i class="fas fa-hamburger fa-fw"></i> &nbsp;
                Ir al menu</a></p>
    </div>
</body>
</html>
<?php include("../../templetes/footer.php"); ?>