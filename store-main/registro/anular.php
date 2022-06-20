<?
require '../factura/Consulta.php';

$consulta = new Consulta();

if (isset($_GET['idFac'])) {
    $id = $_GET['idFac'];
    $datos = $consulta->find('detalleproductos', 'where idFac=?', [$id]);
    $producto = $consulta->find('productos', 'where codigo=?', [$datos['producto']]);

    $suma =  $datos['cantidadP'] + $producto['cantidad'];
    $actualiza = $consulta->editar('productos', 'cantidad=? where codigo=?', [$suma, $datos['producto']]);



    header('Location:index.php?alerta');
}
