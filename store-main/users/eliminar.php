<?
require_once('../factura/Consulta.php');

if (isset($_GET['idUser'])) {
    $id = $_GET['idUser'];
    $consulta = new Consulta();
    $aliminar = $consulta->delete('usuarios', 'where idUser =?', [$id]);
    header('Location:index.php');
}
