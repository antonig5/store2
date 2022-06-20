<?
session_start();
require_once '../factura/Conexion.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Auditorio</title>
    <?
    include_once '../contens/headerA.php';
    ?>

</head>

<body>

    <div class="card mb-2 " style="width: 100%; position: relative; left:1rem; height: 100%">
        <img src="../img/catsoft.jpg" class="card-img-top d-block  px-5 " alt="..." style="position: relative; left:22rem; bottom:-1rem; width: 500px">
        <div class="card-body" style="position:relative; top:-5rem">
            <h5 class="card-title">BIENVENIDO</h5>
            <p class="card-text "></p><? echo $_SESSION['name'] ?> Usuario:<? echo $_SESSION['last'] ?> Tipo:<? echo $_SESSION['tipo'] ?>
            <p class="card-text"><small class="text-muted">Cat soft facil y suave</small></p>
        </div>
    </div>




</body>

</html>