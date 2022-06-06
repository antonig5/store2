<?php
require_once 'Consulta.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $consulta = new Consulta();
    $data = $consulta->find('productos');

    echo $data['nombre'];
    //$crear = $consulta->guardar('productos', '(codigo, nombre, nit, precio, cantidad) values (0011, "hola", 1032222, 1, 2)');



    ?>
    <p>Hola</p>
    <a href="factura.php">Crear factura</a>
</body>

</html>