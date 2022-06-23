<?
require '../factura/Consulta.php';

$consulta = new Consulta();

if (isset($_GET['idFac'])) {
    $id = $_GET['idFac'];



    $update = $consulta->editar('factura', 'idestatus=2 where idFac=?', [$id]);

    header('Location:index.php?alerta');
}
