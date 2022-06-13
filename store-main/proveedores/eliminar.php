<?
require_once('../factura/Consulta.php');

if (isset($_GET['nit'])) {
    $id = $_GET['nit'];
    $consulta = new Consulta();
    $aliminar = $consulta->delete('proveedor', 'where nit =?', [$id]);
    header('Location:index.php');
}
