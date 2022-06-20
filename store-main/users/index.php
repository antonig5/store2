<?php
require('../factura/Consulta.php');


$consulta = new Consulta();
$arrDatos = $consulta->findAll('usuarios, roles where usuarios.idTipo = roles.idTipo');

$consulta = new Consulta();
$data = $consulta->findAll(' roles ');
if (isset($_POST['agregar'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['correo'];
    $password = $_POST['contraseña'];
    $pass_cifrado = password_hash($password, PASSWORD_DEFAULT, array("cons" => 12)); //encripta lo que hay en la variable password
    $rol = $_POST['tipo'];

    $sql = new Consulta();
    $resultado = $sql->guardar("usuarios", "(idTipo, name,user, contraseña, correo) values ( ?,?, ?, ?,?)", array($rol, $nombre, $apellido, $pass_cifrado, $email));



    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en" class="wrapper" id="pages">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
    <?
    include_once '../contens/header.php';
    ?>
</head>
<style>
    body {
        background-color: #343a40;
    }
</style>

<body>
    <div id="page" class="wrapper">

        <table class="table table-dark table-hover ">
            <th class="bg-primary bg-bordered" scope="col">Id</th>
            <th class="bg-primary" scope="col">tipo</th>
            <th class="bg-primary" scope="col">nombre</th>
            <th class="bg-primary" scope="col">user</th>
            <th class="bg-primary" scope="col">email</th>
            <th class="bg-primary" scope="col">contraseña</th>
            <th class="bg-primary" scope="col">Action</th>
            <th class="bg-primary" scope="col"></th>
</body>



<?php

/* var_dump($arrDatos);*/
/*Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch...*/
foreach ($arrDatos as $muestra) {
?>
    <tr>

        <td> <?php echo $muestra['idUser'] ?> </td>
        <td> <?php echo $muestra['tipo'] ?> </td>
        <td> <?php echo $muestra['name'] ?> </td>
        <td> <?php echo $muestra['user'] ?> </td>
        <td> <?php echo $muestra['correo'] ?> </td>
        <td><?php echo /*$persona->clave*/ '°°°°°°°' ?></td>


        <td>
            <a href="eliminar.php?idUser=<?php echo $muestra['idUser'] ?> " class="btn btn-primary">
                eliminar
            </a>

        </td>

        <td>
            <a href="update.php?idUser=<?php echo $muestra['idUser'] ?> " class="btn btn-primary">
                editar
            </a>
        </td>

    </tr>

<?php
}
?>

</table>
<tr>
    <form action="" method="post" class="row g-3">
        <select name="tipo" class=" form-select col-auto mx-5" aria-label=" Default select example" style="width: 10rem;">
            <?
            foreach ($data as $valor) {
                $id = $valor['idTipo'];
                $producto = $valor['tipo'];
            ?>
                <option value="<? echo $id ?>"><? echo $producto ?></option>
            <? }
            ?>

        </select>

        <input type="text" name="nombre" placeholder="Nombre" width="2px" class="form-control col-auto mx-5" style="width: 10rem;">
        <input type="text" name="apellido" placeholder="Usuario" class="form-control  col-auto mx-5" style="width: 10rem;">
        <input type="email" name="correo" placeholder="Email" aria-describedby="emailHelp" class="form-control col-auto mx-5 " style="width: 10rem;">
        <input type="password" name="contraseña" placeholder="Contraseña" aria-describedby="passwordHelpInline" class="form-control col-auto mx-5 " id=" inputPassword2" style="width: 10rem;">

        <input type="submit" name="agregar" class="btn btn-primary  col-auto mx-5 " value="Agregar" style="width: 10rem;">
    </form>

</tr>


</html>