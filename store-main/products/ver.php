<?
session_start();
require('../factura/Consulta.php');


if (isset($_GET['codigo'])) {
    $id = $_GET['codigo'];
    $consulta = new Consulta();
    $traer = $consulta->find('productos,proveedor', 'where codigo=?', [$id]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="../css/card.less">
</head>

<body>




    </head>

    <body>
        <div class="header">

        </div>
        <div class="row1-container">

            <div class="box box-down cyan">
                <a href="../products/index.php" class="close">X</a>
                <h2>Codigo del producto: <? echo $id ?></h2>

                <p>Producto: <? echo $traer['namep'] ?></p>
                <p>Cantidad: <? echo $traer['cantidad'] ?></p>
                <p>Proveedor: <? echo $traer['nombreP'] ?></p>
                <p>Precio: <? echo $traer['precio'] ?></p>
                <img src="../img/catsoft.jpg" alt="" style="width: 10rem;">
            </div>




    </body>


</html>