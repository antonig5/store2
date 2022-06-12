<?php
ob_start();
session_start();
require('../factura/Consulta.php');


$consulta = new Consulta();



$data = $consulta->findAll('usuarios,factura, detalleproductos', 'INNER JOIN clientes ON clientes.documento=detalleproductos.idFac INNER JOIN productos ON productos.codigo = detalleproductos.producto where detalleproductos.idFac=1006729828');





# code...



?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cliente</th>
                <th scope="col">Vendedor</th>
                <th scope="col">Productos</th>
                <th scope="col">Total</th>
            </tr>
        </thead>

        <tbody>
            <?
            foreach ($data as $ver) {
                $id = $ver['idFac'];
                $cliente = $ver['nombre'];
                $vendedor = $ver['name'];
                $total = $ver['total'];
                $producto = $ver['namep'];
            ?>


                <tr>
                    <th scope="row">1</th>
                    <td><? echo $cliente ?></td>

                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td><? echo $vendedor ?></td>

                </tr>

                <tr>
                    <th scope="row">3</th>
                    <td <? echo $producto ?></td>

                </tr>

                <tr>
                    <th scope="row">4</th>
                    <td <? echo $total ?></td>

                </tr>
            <?
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
$html = ob_get_clean();
//echo $html;

require_once '../../includes/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getoptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setoptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper("letter");
//$dompdf->set Paper('A4','Landscape');
$dompdf->render();
$dompdf->stream("archivo_.pdf", array("Attachment" => false));
