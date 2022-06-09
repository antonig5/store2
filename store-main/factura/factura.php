<?php
require('../factura/Consulta.php');

$buscar = $_GET['busca'];
$consulta = new Consulta();
$data = $consulta->findAll('clientes', 'where documento=?', [$buscar]);


if (isset($_GET['busca']) == $data) {
    $consulta = new Consulta();
    $arrDatos = $consulta->findAll('detalleproductos', 'INNER JOIN productos ON productos.codigo = detalleproductos.producto');
    $consulta = new Consulta();
    $data = $consulta->findAll('productos');
    if (isset($_POST['agregar'])) {

        $nombre = $_POST['product'];
        $precio = $_POST['price'];
        $cantidad = $_POST['cand'];
        $sql = new Consulta();
        $resultado = $sql->guardar('detalleproductos', '(producto,cantidad,valor) values ( ?,?,?)', array($nombre, $cantidad, $precio));
        header("Location:factura.php");
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


        <div id="page" class="wrapper">

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

        $T = $T + $muestra['valor'];
    ?>
        <tr>
            <td> <?php echo $muestra['idFacD'] ?> </td>
            <td> <?php echo $muestra['nombre'] ?> </td>
            <td> <?php echo $muestra['cantidadP'] ?> </td>
            <td> <?php echo $muestra['valor'] ?> </td>
            <td>
                <a href="eliminar.php?idUser=<?php echo $muestra['idUser'] ?> " class="btn btn-primary">
                    eliminar
                </a>

            </td>

            <td>
                <a href="update.php?codigo=<?php echo $muestra['codigo'] ?> " class="btn btn-primary">
                    editar
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
    <tr>
        <form action="" method="post" class="row g-3">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <select class="form-control col-auto mx-5" style="width: 10rem;" name="product">
                <?php
                foreach ($data as $valor) {
                ?>

                    <option data-typeid="<?php echo $valor['precio'] ?>" value="<?php echo $valor['codigo'] ?>"><?php echo $valor['nombre'] ?></option>

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