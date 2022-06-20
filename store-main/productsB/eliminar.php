<?
require_once('../factura/Consulta.php');

if (isset($_GET['codigo'])) {
    $id = $_GET['codigo'];
    $consulta = new Consulta();
    $aliminar = $consulta->delete('productos', 'where codigo =?', [$id]);
    header('Location:index.php');
}
