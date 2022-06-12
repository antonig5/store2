<?php
require('../factura/Consulta.php');

$id = $_GET['idFacD'];
if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];
    $code = $_GET['code'];
    $cantidad = $_GET['cantidad'];
    $consulta = new Consulta();
    $eliminar = $consulta->delete('detalleproductostemporal', 'where idFacD=?', [$id]);
    $eliminar2 = $consulta->delete('detalleproductos', 'where idFacD=?', [$id]);
    $actualiza = $consulta->editar('productos', 'cantidad=? where codigo=?', array($cantidad, $code));
    header("Location:factura.php?busca=$busca");
    # code...
}
