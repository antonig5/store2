<?php
require('../factura/Consulta.php');


$consulta = new Consulta();
$arrDatos = $consulta->findAll('factura,usuarios,clientes', 'where factura.cliente=clientes.documento and factura.vendedor=usuarios.idUser');



?>

<!DOCTYPE html>
<html lang="en" class="wrapper" id="pages">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
    <?
    include_once '../contens/header.php';
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



        <td>
            <a href="../factura/pdf.php?client=<? echo $muestra['cliente'] ?> " class="btn btn-primary">
                Ver
            </a>

        </td>



    </tr>

<?php
}
?>

</table>



</html>