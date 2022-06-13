<?
require('../factura/Consulta.php');

$traer = $_GET['nit'];
$sql = new Consulta();
$datos = $sql->find('proveedor', 'where nit=?', [$traer]);

if (isset($_POST['update'])) {
    $id = $_POST["id"];
    $nombre = $_POST["name"];
    $dir = $_POST["tel"];
    $tele = $_POST["dir"];
    $sql = new Consulta();
    $datos = $sql->editar('proveedor', 'nombreP=?,telefono=?,direccion=? where nit=?', array($nombre, $tele, $dir, $id));

    header('Location:index.php');  # code...
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet/less" type="text/css" href="../css/style.less">
    <script src="../js/less.js" type="text/javascript"></script>
    <title>Document</title>
</head>




<body>
    <div class="container">
        <div class="card__container">

            <div class="card">
                <div class="card__content">
                    <h3 class="card__header">Nit Nº <? echo $datos['nit'] ?></h3>
                    <form action="" method="POST">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <p class="card__info">Nombre: </p>
                                    </th>
                                    <th>
                                        <p class="card__info">Telefono: </p>
                                    </th>
                                    <th>
                                        <p class="card__info">Direccion: </p>
                                    </th>
                                </tr>

                            </thead>
                            <tr>
                                <td>
                                    <p class="card__info"> <input type="text" value="<? echo $datos['nombreP'] ?>" name="name"></p>
                                </td>
                                <td>
                                    <p class="card__info">
                                        <input type="number" value="<? echo $datos['telefono'] ?>" name="tel">

                                    </p>
                                </td>
                                <td>
                                    <p class="card__info"><input type="text" value="<? echo $datos['direccion'] ?>" name="dir"> </p>
                                </td>
                                <input type="hidden" value="<? echo $traer ?>" name="id">
                            </tr>

                        </table>
                        <input name="update" class="card__button" value="Volver" type="submit">
                    </form>

                </div>
            </div>

        </div>
    </div>
</body>

</html>