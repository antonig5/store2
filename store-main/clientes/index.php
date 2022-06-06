<?php
require('../factura/Consulta.php');


$consulta = new Consulta();
$arrDatos = $consulta->findAll('clientes');


if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tele = $_POST['tele'];
    $dir = $_POST['dir'];
    $doc = $_POST['doc'];
    $sql = new Consulta();
    $resultado = $sql->guardar("clientes", "(documento, nombre,apellido,telefono,direccion) values ( ?,?, ?, ?,?)", array($doc, $nombre, $apellido, $tele, $dir));



    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en" id="pages">


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

<body>
    <div id="page" class="wrapper">

        <table class="table ">
            <th class="bg-primary bg-bordered" scope="col">Documento</th>

            <th class="bg-primary" scope="col">Nombre</th>
            <th class="bg-primary" scope="col">Apellido</th>
            <th class="bg-primary" scope="col">Telefono</th>
            <th class="bg-primary" scope="col">Direccion</th>
            <th class="bg-primary" scope="col">Action</th>
            <th class="bg-primary" scope="col"></th>
</body>



<?php

/* var_dump($arrDatos);*/
/*Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch...*/
foreach ($arrDatos as $muestra) {
?>
    <tr>


        <td> <?php echo $muestra['documento'] ?> </td>
        <td> <?php echo $muestra['nombre'] ?> </td>
        <td> <?php echo $muestra['apellido'] ?> </td>
        <td> <?php echo $muestra['telefono'] ?> </td>
        <td><?php echo $muestra['direccion'] ?></td>


        <td>
            <a href="eliminar.php?idUser=<?php echo $muestra['idUser'] ?> " class="btn btn-primary">
                eliminar
            </a>

        </td>

        <td>
            <a href="actualizar.php?idUser=<?php echo $muestra['idUser'] ?> " class="btn btn-primary">
                editar
            </a>
        </td>

    </tr>

<?php
}
?>

</table>
<tr>
    <form action="" method="post" class="row g-3">
        <input type="text" name="doc" placeholder="Documento" width="2px" class="form-control col-auto mx-5" style="width: 10rem;">
        <input type="text" name="nombre" placeholder="Nombre" width="2px" class="form-control col-auto mx-5" style="width: 10rem;">
        <input type="text" name="apellido" placeholder="Apellido" class="form-control  col-auto mx-5" style="width: 10rem;">
        <input type="text" name="dir" placeholder="Direccion" class="form-control col-auto mx-5 " style="width: 10rem;">
        <input type="number" name="tele" placeholder="Telefono" class="form-control col-auto mx-5 " style="width: 10rem;">

        <input type="submit" name="agregar" class="btn btn-primary  col-auto mx-5 " value="Agregar" style="width: 10rem;">
    </form>

</tr>


</html>