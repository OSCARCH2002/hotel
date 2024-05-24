<?php include("../../templetes/head.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="../../assets/platillos/tacos.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Tacos</h5>
                        <p class="card-text">Precio: $15 C/U</p>
                        <form action="../../pages/usuario/carrito.php" method="POST">
                            <input type="hidden" id="producto_id_1" name="producto_id">
                            <input type="hidden" name="nombre_producto" value="Tacos">
                            <input type="hidden" name="precio" value="15">
                            <div class="form-group">
                                <label for="tacoType" style="color: #1B396A;">Selecciona un tipo de taco:</label>
                                <select class="form-control form-control-sm" id="tacoType" name="tipo_comida" onchange="updateProductId(1, this)">
                                    <option value="1">Cecina</option>
                                    <option value="Chicharron">Chicharrón</option>
                                    <option value="3">Arroz con huevo</option>
                                    <option value="4">Chorizo</option>
                                    <option value="5">Mole</option>
                                    <option value="6">Barbacoa</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="quantity">Cantidad:</label>
                                <input type="number" class="form-control form-control-sm" id="quantity" name="cantidad" min="1" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="../../assets/platillos/sope.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Sopes</h5>
                        <p class="card-text">Precio: $15 C/U</p>
                        <form action="../../pages/usuario/carrito.php" method="POST">
                            <input type="hidden" id="producto_id_2" name="producto_id">
                            <input type="hidden" name="nombre_producto" value="Sopes">
                            <input type="hidden" name="precio" value="15">
                            <div class="form-group">
                                <label for="sopeType" style="color: #1B396A;">Selecciona un tipo de sope:</label>
                                <select class="form-control form-control-sm" id="sopeType" name="tipo_comida" onchange="updateProductId(2, this)">
                                    <option value="7">Pollo</option>
                                    <option value="8">Chorizo</option>
                                    <option value="9">Tinga</option>
                                    <option value="10">Oaxaca</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Cantidad:</label>
                                <input type="number" class="form-control form-control-sm" id="quantity" name="cantidad" min="1" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="../../assets/platillos/torta.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Tortas</h5>
                        <p class="card-text">Precio: $35 C/U</p>
                        <form action="../../pages/usuario/carrito.php" method="POST">
                            <input type="hidden" id="producto_id_3" name="producto_id">
                            <input type="hidden" name="nombre_producto" value="Tortas">
                            <input type="hidden" name="precio" value="35">
                            <div class="form-group">
                                <label for="tortaType">Selecciona un tipo de torta:</label>
                                <select class="form-control form-control-sm" id="tortaType" name="tipo_comida" onchange="updateProductId(3, this)">
                                    <option value="11">Salchicha</option>
                                    <option value="12">Jamón</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Cantidad:</label>
                                <input type="number" class="form-control form-control-sm" id="quantity" name="cantidad" min="1" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="../../assets/platillos/tostadas.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Tostadas</h5>
                        <p class="card-text">Precio: $35 la orden</p>
                        <form action="../../pages/usuario/carrito.php" method="POST">
                            <input type="hidden" id="producto_id_4" name="producto_id" value="13">
                            <input type="hidden" name="nombre_producto" value="Tostadas">
                            <input type="hidden" name="precio" value="35">
                            <input type="hidden" name="tipo_comida" value="Tostadas"> <!-- Campo tipo_comida añadido -->
                            <div class="form-group">
                                <label for="quantity">Cantidad:</label>
                                <input type="number" class="form-control form-control-sm" id="quantity" name="cantidad" min="1" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="../../assets/platillos/sanwich.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Sándwich</h5>
                        <p class="card-text">Precio: $25 C/U</p>
                        <form action="../../pages/usuario/carrito.php" method="POST">
                            <input type="hidden" id="producto_id_5" name="producto_id" value="14">
                            <input type="hidden" name="nombre_producto" value="Sándwich">
                            <input type="hidden" name="precio" value="25">
                            <input type="hidden" name="tipo_comida" value="Sándwich"> <!-- Campo tipo_comida añadido -->
                            <div class="form-group">
                                <label for="quantity">Cantidad:</label>
                                <input type="number" class="form-control form-control-sm" id="quantity" name="cantidad" min="1" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="../../assets/platillos/nugget.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Spaguetti con Nuggets</h5>
                        <p class="card-text">Precio: $35 C/U</p>
                        <form action="../../pages/usuario/carrito.php" method="POST">
                            <input type="hidden" id="producto_id_6" name="producto_id" value="15">
                            <input type="hidden" name="nombre_producto" value="Spaguetti con Nuggets">
                            <input type="hidden" name="precio" value="35">
                            <input type="hidden" name="tipo_comida" value="Spaguetti con Nuggets"> <!-- Campo tipo_comida añadido -->
                            <div class="form-group">
                                <label for="quantity">Cantidad:</label>
                                <input type="number" class="form-control form-control-sm" id="quantity" name="cantidad" min="1" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function updateProductId(cardId, select) {
            var productId = select.value;
            if (productId === "") {
                productId = select.options[0].value;
            }
            document.getElementById('producto_id_' + cardId).value = productId;
        }
    </script>
</body>

</html>
<?php include("../../templetes/footer.php"); ?>