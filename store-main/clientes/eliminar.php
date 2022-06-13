<?
require_once('../factura/Consulta.php');

if (isset($_GET['documento'])) {
    $id = $_GET['documento'];
    $consulta = new Consulta();
    $aliminar = $consulta->delete('clientes', 'where documento =?', [$id]);
    header('Location:index.php');
}
