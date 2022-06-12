<?
require('../factura/Consulta.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <script src="alert/dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="alert/dist/sweetalert.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>


    <?






    if (isset($_GET['enviar'])) {
        $datos = $_GET['T'];
        $id = $_GET['client'];
        $vendedor = $_GET['vent'];

        $consulta = new Consulta();
        $actualizar = $consulta->guardar('factura', '(cliente,vendedor,total) values (?,?,?)', array($id, $vendedor, $datos));
        $delete = $consulta->delete('detalleproductostemporal', 'where ?', array($id));
        header('Location:pdf.php');
    }


    if (isset($_GET['no'])) {
        $datos = $_GET['T'];
        $id = $_GET['client'];
        $vendedor = $_GET['vent'];

        $consulta = new Consulta();
        $actualizar = $consulta->guardar('factura', '(cliente,vendedor,total) values (?,?,?)', array($id, $vendedor, $datos));
        $delete = $consulta->delete('detalleproductostemporal', 'where ?', array($id));
        header('Location:index.php'); # code...
    }










    ?>

</body>

</html>