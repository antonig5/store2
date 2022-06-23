<?php
session_start();
require('../factura/Consulta.php');


$consulta = new Consulta();
$arrDatos = $consulta->findAll('factura,usuarios,clientes', 'where factura.cliente=clientes.documento and factura.vendedor=usuarios.idUser and idestatus=1');

$data = $consulta->findAll('detalleproductos');

?>

<!DOCTYPE html>
<html lang="en" class="wrapper" id="pages">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../node_modules/alertifyjs/build/alertify.min.js"></script>
    <!-- include the style -->
    <link rel="stylesheet" href="../../node_modules/alertifyjs/build/css/alertify.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="../../node_modules/alertifyjs/build/css/themes/default.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
    <?
    if ($_SESSION['tipo'] == 6) {
        include_once '../contens/headerA.php';
    } else {
        include_once '../contens/header.php';
    }



    ?>
</head>
<style>
    body {
        background-color: #343a40;
    }
</style>

<body>
    <div id="page" class="wrapper">

        <table class="table table-dark table-hover ">
            <th class="bg-primary bg-bordered" scope="col">Id</th>
            <th class="bg-primary" scope="col">Cliente</th>
            <th class="bg-primary" scope="col">Vendedor</th>
            <th class="bg-primary" scope="col">Total</th>
            <th class="bg-primary" scope="col">Fecha</th>

            <th class="bg-primary" scope="col">Action</th>
            <th class="bg-primary" scope="col"></th>
</body>



<?php
if (isset($_GET['alerta'])) {
    foreach ($data as $dad) {
        $datos = $consulta->find('detalleproductos', 'where idFac=?', [$dad['idFac']]);
        $producto = $consulta->find('productos', 'where codigo=?', [$dad['producto']]);
        $suma =  $dad['cantidadP'] + $producto['cantidad'];
        $actualiza = $consulta->editar('productos', 'cantidad=? where codigo=?', [$suma, $producto['codigo']]);
    }
    echo '<script> window.location ="index.php?alert"</script>';
}


/* var_dump($arrDatos);*/
/*Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch...*/
foreach ($arrDatos as $muestra) {

?>
    <tr>

        <td> <?php echo $muestra['idFac'] ?> </td>
        <td> <?php echo $muestra['nombre'] ?> </td>
        <td> <?php echo $muestra['name'] ?> </td>
        <td> <?php echo $muestra['total'] ?> </td>
        <td> <?php echo $muestra['fecha'] ?> </td>



        <?
        if ($_SESSION['tipo'] == 6) {
        ?>

            <td>
                <a href="../factura/pdf.php?idFac=<? echo $muestra['idFac'] ?> " class="btn btn-primary">
                    Ver
                </a>

            </td>

            <td>
                <a href="anular.php?idFac=<? echo $muestra['idFac'] ?> " class="btn btn-primary">
                    Anular
                </a>

            </td>

        <?
        } else {
        ?>
            <td>
                <a href="../factura/pdf.php?idFac=<? echo $muestra['idFac'] ?> " class="btn btn-primary">
                    Ver
                </a>

            </td>
        <?
        }
        ?>

    </tr>

<?php
}
?>

</table>


<?
if (isset($_GET['alert'])) {

?>
    <script>
        alertify.success("Factura anulada");
    </script>
<?

}

?>

</html>