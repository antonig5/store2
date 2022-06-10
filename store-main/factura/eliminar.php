<?php
require('../factura/Consulta.php');

$id = $_GET['idFacD'];
if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];
    # code...
}

$consulta = new Consulta();
$eliminar = $consulta->delete('detalleproductos', 'where idFacD=?', [$id]);
header("Location:factura.php?busca=$busca");
