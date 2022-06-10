<?
require('../factura/Consulta.php');

if (isset($_GET['editar'])) {

    $datos = $_GET['can'];
    $id = $_GET['id'];

    $consulta = new Consulta();
    $actualizar = $consulta->editar('productos', 'cantidad=? where codigo=? ', [$datos, $id]);
    $delete = $consulta->delete('detalleproductos', 'where ?', [$id]);
    header('Location:factura.php');
    # code...
}
