<?php
require('../factura/Consulta.php');


$consulta = new Consulta();
$arrDatos = $consulta->findAll('productos, proveedor', 'where productos.nit = proveedor.nit');

$consulta = new Consulta();
$data = $consulta->findAll('proveedor');
if (isset($_POST['agregar'])) {

    $nombre = $_POST['nombre'];
    $precio = $_POST['price'];
    $cantidad = $_POST['cand'];
    $nit = $_POST['tipo'];

    $sql = new Consulta();
    $resultado = $sql->guardar("productos", "( nombre,nit,precio,cantidad) values ( ?,?,?,?)", array($nombre, $nit, $precio, $cantidad));



    header("Location:index.php");
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
    <?
    include_once '../contens/header.php';
    ?>
</head>

<body>


    <div id="page" class="wrapper">

        <table class="table ">
            <th class="bg-primary bg-bordered" scope="col">Code</th>

            <th class="bg-primary" scope="col">Nombre</th>
            <th class="bg-primary" scope="col">Proveedor</th>
            <th class="bg-primary" scope="col">Precio</th>
            <th class="bg-primary" scope="col">Cantidad</th>
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

        <td> <?php echo $muestra['codigo'] ?> </td>

        <td> <?php echo $muestra['nombre'] ?> </td>
        <td> <?php echo $muestra['nombreP'] ?> </td>
        <td> <?php echo $muestra['precio'] ?> </td>
        <td><?php echo $muestra['cantidad'] ?></td>
        <td><?php echo $muestra['fecha'] ?></td>


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

</table>
<tr>
    <form action="" method="post" class="row g-3">
        <select name="tipo" class=" form-select col-auto mx-5" aria-label=" Default select example" style="width: 10rem;">
            <?
            foreach ($data as $valor) {
                $id = $valor['nit'];
                $producto = $valor['nombreP'];
            ?>
                <option value="<? echo $id ?>"><? echo $producto ?></option>
            <? }
            ?>

        </select>

        <input type="text" name="nombre" placeholder="Producto" width="2px" class="form-control col-auto mx-5" style="width: 10rem;">
        <input type="number" name="price" placeholder="Precio" class="form-control  col-auto mx-5" style="width: 10rem;">
        <input type="number" name="cand" placeholder="Cantidad" class="form-control col-auto mx-5 " style="width: 10rem;">


        <input type="submit" name="agregar" class="btn btn-primary  col-auto mx-5 " value="Agregar" style="width: 10rem;">
    </form>

</tr>


</html>