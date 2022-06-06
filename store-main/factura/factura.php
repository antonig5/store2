<?
include('Consulta.php');

$consulta = new Consulta();
$data = $consulta->findAll('productos');
$consulta2 = new Consulta();
$data2 = $consulta2->findAll('detalletemporal');

if (isset($_POST['envia'])) {
    $product = $_POST['product'];
    $cand = $_POST['cand'];
    $val = $_POST['valor'];
    $consulta = new Consulta();
    $traer = $consulta->guardar('detalleproductos', "(producto, cantidad,valor) values ($product,$cand,$val)");
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <select name="product">
            <?
            foreach ($data as $valor) {
                $id = $valor['code'];
                $producto = $valor['nombre'];
            ?>
                <option value="<? echo $id ?>"><? echo $producto ?></option>
            <? }
            ?>

        </select>
        <input type="text" name="cand">
        <input type="text" name="valor">
        <input type="submit" value="enviar" name="envia">


        <table>
            <thead>
                <th>producto</th>
                <th></th>
                <th>total</th>

            </thead>
            <?
            foreach ($data as $ser) {
                $result =  $ser['precio'];
                $nombre = $ser['nombre'];

            ?>


                <tr>

                    <td><? echo $nombre ?></td>
                    <td><? echo $result ?></td>
                    <td></td>

                </tr>
            <? } ?>
            <?
            foreach ($data2 as $ver) {
                $total = $ver['cantidad'] * $result

            ?>
                <h2>total:<? echo $total ?></h2>
            <? } ?>
        </table>



    </form>
</body>

</html>