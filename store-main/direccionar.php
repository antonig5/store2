<?php
session_start();
require("factura/Consulta.php");

if (!isset($_POST["user"]) and !isset($_POST["envia"])) {
    header("Location:login.php");
} else if (isset($_POST["envia"])) {

    try {

        $login =             htmlentities(addslashes($_POST["user"]));
        $password =          htmlentities(addslashes($_POST["password"]));
        $contador = 0;


        $sql = new Consulta();
        $resultado = $sql->find('usuarios', 'where user =? ', array($login));

        if ($registro = $resultado) {
            $_SESSION['name'] = $registro['name'];
            $_SESSION['last'] = $registro['user'];
            $_SESSION['id'] = $registro['idUser'];


            if (password_verify($password, $registro['contraseña'])) {

                $valida =            $registro['idTipo'];
                $nombre =            $registro['nombre'];
                $usuario =           $registro['user'];
                $contador++;
            }
        }

        if ($contador > 0) {

            if ($valida == 1) {
                header("Location:admin/index.php");
            } else if ($valida == 2) {
                header("Location:vendedor/index.php");
            }
        } elseif (!isset($_SESSION['id']) ||  !isset($valida)) {
            header("Location:index.php");
            exit;
        } else {
            header("Location:index.php");
        }
        $resultado->closecursor();
        $base_de_datos->exec("set character set utf8");
    } catch (Exception $e) {
        die("error" . $e->getMessage());
    }
}
