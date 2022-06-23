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
        $fac = $_GET['fac'];
        $cantidad = $_GET['cantidad'];
        $code = $_GET['codigo'];
        $consulta = new Consulta();
        $actualizar = $consulta->guardar('factura', '(cliente,vendedor,total,idestatus) values (?,?,?,1)', array($id, $vendedor, $datos));
        $ver = $consulta->find('factura', ' ORDER BY idFac DESC');
        $cre = $consulta->editar('detalleproductostemporal', 'idFac=?', array($ver['idFac']));
        $llamar = $consulta->findAll('detalleproductostemporal');
        $resultado2 = $consulta->guardar('detalleproductos', "(idFacD,idFac,producto,cantidadP,valor) SELECT * FROM detalleproductostemporal");
        $delete = $consulta->delete('detalleproductostemporal', 'where ?', array($id));
        $actualiza = $consulta->editar('productos', 'cantidad=? where codigo=?', array($cantidad, $code));

        $tare = $consulta->find('factura', ' ORDER BY idFac DESC');
        $f = $tare['idFac'];

        header("Location:pdf.php?idFac=$f");
    }


    if (isset($_GET['no'])) {

        header('Location:index.php'); # code...
    }










    ?>

</body>

</html>