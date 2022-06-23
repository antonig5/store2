<?php
require_once "Conexion.php";



class Consulta
{



  public  function findAll($tabla, $condiciones = null, $arraycondicion = null)
  {
    $con = new Conexion();
    $consulta = $con->prepare('SELECT *  FROM ' . $tabla . ' ' . $condiciones . ' ');
    $consulta->execute($arraycondicion);
    $registros = $consulta->fetchAll();

    if (isset($registros)) {
      return $registros;
    } else {
      return 'fail';
    }
  }

  public  function find($tabla, $condiciones = null, $arraycondicion = null)
  {
    $con = new Conexion();
    $consulta = $con->prepare('SELECT * FROM ' . $tabla . ' ' . $condiciones . ' ');
    $consulta->execute($arraycondicion);
    $registros = $consulta->fetch();
    if (isset($registros)) {
      return $registros;
    }
  }




  public  function guardar($tabla, $values, $arraycondicion = null)
  {
    $con = new Conexion();
    $consulta = $con->prepare('INSERT INTO ' . $tabla . ' ' . $values . ' ');
    $consulta->execute($arraycondicion);


    return $con->lastInsertId();
  }



  public  function editar($tabla, $values, $arraycondicion = null)
  {
    $con = new Conexion();
    $consulta = $con->prepare('UPDATE ' . $tabla . ' SET ' . $values . ' ');
    $rows = $consulta->execute($arraycondicion);


    return true;
  }



  public  function delete($tabla, $values, $arraycondicion = null)
  {
    $con = new Conexion();
    $consulta = $con->prepare('DELETE FROM ' . $tabla . ' ' . $values . ' ');
    $rows = $consulta->execute($arraycondicion);


    return true;
  }
}
