<?php
session_start();
require('../factura/Consulta.php');

$buscar = $_GET['busca'];
$consulta = new Consulta();
$data = $consulta->findAll('clientes', 'where documento=?', [$buscar]);



if (isset($_GET['busca']) == $data) {
    $consulta = new Consulta();
    $arrDatos = $consulta->findAll('detalleproductostemporal', 'INNER JOIN productos ON productos.codigo = detalleproductostemporal.producto');
    $consulta = new Consulta();
    $data = $consulta->findAll('productos');


    if (isset($_POST['agregar'])) {
        if ($_POST['product'] == $_POST['product']) {
            # code...
        } else {
            $nombre = $_POST['product'];
            $precio = $_POST['price'];
            $cantidad = $_POST['cand'];

            $sql = new Consulta();
            $resultado = $sql->guardar('detalleproductostemporal', '(idFac,producto,cantidadP,valor) values (?,?,?,?)', array($buscar, $nombre, $cantidad, $precio));
            $resultado2 = $sql->guardar('detalleproductos', '(idFac,producto,cantidadP,valor) values (?,?,?,?)', array($buscar, $nombre, $cantidad, $precio));
        }


        header("Location:factura.php?busca=$buscar");
    }
?>

    <!DOCTYPE html>
    <html lang="en" class="wrapper" id="pages">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Document</title>
        <?php
        include_once '../contens/header.php';
        ?>
    </head>

    <body>
        <? ?>

        <div id="page" class="wrapper">
            <form action="<? $_SERVER['PHP_SELF'] ?>" method="GET">




                <table class="table ">
                    <th class="bg-primary bg-bordered" scope="col">Code</th>
                    <th class="bg-primary" scope="col">Nombre</th>
                    <th class="bg-primary" scope="col">Cantidad</th>
                    <th class="bg-primary" scope="col">Precio</th>
                    <th class="bg-primary" scope="col">Action</th>
                    <th class="bg-primary" scope="col"></th>
    </body>



    <?php
    $T = 0;
    /* var_dump($arrDatos);*/
    /*Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch...*/
    foreach ($arrDatos as $muestra) {
        $cat = $muestra['cantidad'] - $muestra['cantidadP'];
        $catt = $muestra['cantidadP'] + $muestra['cantidad'] - $muestra['cantidadP'];
        $T = $T + $muestra['valor'] * $muestra['cantidadP'];
        $m = $muestra['codigo'];

        $f = $consulta->findAll('productos', 'where codigo=?', array($m));




        $actualizar = $consulta->editar('productos', 'cantidad=? where codigo=?', [$cat, $m]);
    ?>
        <tr>
            <input type="hidden" value="<? echo $cat ?>" name="can">
            <input type="hidden" value="<? echo $muestra['codigo'] ?>" name="id">
            <td> <?php echo $muestra['idFacD'] ?></td>
            <td> <?php echo $muestra['namep'] ?> </td>
            <td> <?php echo $muestra['cantidadP'] ?> </td>
            <td> <?php echo $muestra['valor'] ?> </td>
            <td>
                <a href="eliminar.php?idFacD=<?php echo $muestra['idFacD'] ?> &busca=<?php echo $buscar ?> &cantidad=<?php echo $catt ?> &code=<? echo $muestra['codigo'] ?>" class="btn btn-primary">

                    eliminar
                </a>

            </td>



        </tr>
    <?php
    }
    ?>
    <tfoot>

        <tr>
            <th class="text-right" colspan="4">Gran total</th>
            <th><?php echo $T ?> </th>

        </tr>
    </tfoot>
    </table>

    </form>


    <tr>
        <form action="" method="post" class="row g-3">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <select class="form-control col-auto mx-5" style="width: 10rem;" name="product">
                <?php
                foreach ($data as $valor) {
                ?>

                    <option data-typeid="<?php echo $valor['precio'] ?>" value="<?php echo $valor['codigo'] ?>"><?php echo $valor['namep'] ?></option>

                <?php
                } ?>

            </select>
            <input type="number" value="" id="money" class="form-control col-auto mx-5" style="width: 10rem;" name="price" placeholder="Precio" readonly>
            <script type="text/javascript">
                $(document).on('change', 'select.form-control', function() {
                    var r = $('select.form-control option[value="' + $(this).val() + '"]').attr("data-typeid")
                    $("#money").val(r)
                });
            </script>







            <input type="number" name="cand" placeholder="Cantidad" class="form-control col-auto mx-5 " style="width: 10rem;">


            <input type="submit" name="agregar" class="btn btn-primary  col-auto mx-5 " value="Agregar" style="width: 10rem;">
        </form>

    </tr>
    <form action="actualizar.php" method="GET">

        <input type="hidden" value="<? echo $T ?>" name="T">
        <input type="hidden" value="<? echo $buscar ?>" name="client">
        <input type="hidden" value="<? echo $_SESSION['id'] ?>" name="vent">



        <th><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Comprar
            </button></th>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Desea generar la compra?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="no" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="enviar" class="btn btn-success">SI</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    </html>


<?php


} else {
    include 'index.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <script src="../../node_modules/alertifyjs/build/alertify.min.js"></script>
        <!-- include the style -->
        <link rel="stylesheet" href="../../node_modules/alertifyjs/build/css/alertify.css" />
        <!-- include a theme -->
        <link rel="stylesheet" href="../../node_modules/alertifyjs/build/css/themes/default.min.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <script>
            alertify.error("El cliente no registrado");
        </script>
    </body>

    </html>



<?

}

?>