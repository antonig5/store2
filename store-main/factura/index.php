<?php
session_start();
require_once('Consulta.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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

    <?php
    $consulta = new Consulta();
    $data = $consulta->find('clientes');

    //$crear = $consulta->guardar('productos', '(codigo, nombre, nit, precio, cantidad) values (0011, "hola", 1032222, 1, 2)');

    ?>

    <form class="mt-5" action="factura.php" method="GET">
        <div class="row justify-content-center mb-3 ">
            <div class="col-md-3">
                <input class="form-control me-2" type="number" placeholder="Documento" aria-label="Search" name="busca">
                <button class="btn btn-success" type="submit" id="buscar">Buscar</button>
    </form>
</body>

</html>