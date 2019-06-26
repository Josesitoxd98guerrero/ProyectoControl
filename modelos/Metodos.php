<?php
class Metodos
{
  //funcion para mostrar datos
  public function mostrarDatos($sql){
    $c= new conectar();
    $conexion=$c->conexion();

    $result=mysqli_query($conexion,$sql);

    return mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
  //funcion para marcar la salida de personal
  public function insertarEntrada($datos){
    $c= new conectar();
    $conexion=$c->conexion();

    $sql="INSERT INTO ingreso_salida(id_personal,fecha,hora_entrada) values($datos[0],CURDATE(),CURTIME())";

    return $result=mysqli_query($conexion,$sql);
  }
  //funcion para marcar la salida de personal
  public function marcarsalida($datos){
    $c= new conectar();
    $conexion=$c->conexion();

    $sql="UPDATE ingreso_salida SET hora_salida=CURTIME() WHERE id_personal=$datos[0] and fecha=CURDATE()";
    return $result=mysqli_query($conexion,$sql);

  }
  //funcion para validar el boton de entrada
  public function validarbotonentrada($sql)
  {
    $c= new conectar();
    $conexion=$c->conexion();

    $result=mysqli_query($conexion,$sql);

    return mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
}


 ?>
