<?php

ob_start();
session_start();
require('../factura/Consulta.php');


if (isset($_GET['client'])) {
    $id = $_GET['client'];
    $consulta = new Consulta();
    $data = $consulta->find('factura,clientes,usuarios,detalleproductos', 'where factura.cliente=? ', [$id]);
    $produc = $consulta->findAll('detalleproductos', 'INNER JOIN productos ON productos.codigo = detalleproductos.producto  where detalleproductos.idFac=?', [$id])
?>

    <!DOCTYPE html>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Document</title>
    </head>


    <style>
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);

        }

        .styled-table thead tr {
            background-color: black;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid black;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: white;
            background-color: gray;
        }
    </style>

    <body>

        <style>

        </style>

        <table class="styled-table">
            <thead>
                <tr>
                    <th class="bg-primary bg-bordered" scope="col">Id</th>
                    <th class="bg-primary" scope="col">Cliente</th>
                    <th class="bg-primary" scope="col">Vendedor</th>
                    <th class="bg-primary" scope="col">Total</th>
                    <th class="bg-primary" scope="col">Fecha</th>


                </tr>

            </thead>

            <tbody>
                <tr class="active-row">

                    <td> <?php echo $data['idFacD'] ?> </td>
                    <td> <?php echo $data['name'] ?> </td>
                    <td> <?php echo $data['nombre'] ?> </td>

                    <td> <?php echo $data['total'] ?> </td>
                    <td> <?php echo $data['fecha'] ?> </td>







                </tr>
            </tbody>



        </table>

        <table class="styled-table">
            <th>Productos</th>
            <th>Precio</th>
            <th>cantidad</th>


            <?
            foreach ($produc as $ver) {
                $productos = $ver['namep'];
                $precio = $ver['precio'];

            ?>
                <tr>

                    <td> <?php echo $productos ?></td>
                    <td><?php echo $precio ?></td>
                    <td><?php echo $data['cantidadP'] ?></td>
                </tr>

            <?  } ?>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Total</th>
                    <th> <?php echo $data['total'] ?> </th>
                </tr>
            </tfoot>
        </table>
    </body>

    </html>

<?php

}
require_once  '../../includes/dompdf/autoload.inc.php';

$html = ob_get_clean();
//echo $html;
use Dompdf\Dompdf;

$dompdf = new Dompdf();


$dompdf->loadHtml($html);
$dompdf->setPaper("letter");

$dompdf->render();
$dompdf->stream("archivo_.pdf", array("Attachment" => false));
