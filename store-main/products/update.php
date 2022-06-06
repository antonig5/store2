<?
require('../factura/Consulta.php');

$traer = $_GET['codigo'];
$sql = new Consulta();
$datos = $sql->find('productos', 'where codigo=?', [$traer]);

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $precio = $_POST['price'];
    $cantidad = $_POST['cand'];
    $producto = $_POST['name'];

    $cosulta = new Consulta();
    $act = $cosulta->editar("productos", 'nombre=?,cantidad=?,precio=? ', 'where codigo=?', array($producto, $cantidad, $precio, $id));
    header('Location:index.php');
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
                    <h3 class="card__header">Producto Nº <? echo $datos['codigo'] ?></h3>
                    <form action="" method="POST">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <p class="card__info">Nombre: </p>
                                    </th>
                                    <th>
                                        <p class="card__info">Cantidad: </p>
                                    </th>
                                    <th>
                                        <p class="card__info">Precio: </p>
                                    </th>
                                </tr>

                            </thead>
                            <tr>
                                <td>
                                    <p class="card__info"> <input type="text" value="<? echo $datos['nombre'] ?>" name="name"></p>
                                </td>
                                <td>
                                    <p class="card__info">
                                        <input type="text" value="<? echo $datos['cantidad'] ?>" name="cand">

                                    </p>
                                </td>
                                <td>
                                    <p class="card__info"><input type="text" value="<? echo $datos['precio'] ?>" name="price"> </p>
                                </td>
                                <input type="text" value="<? echo $traer ?>" name="id">
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