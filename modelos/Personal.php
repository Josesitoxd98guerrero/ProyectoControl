<?php
class Personal
{
  //funcion para mostrar datos
  public function mostrarpersonal($sql){
    $c= new conectar();
    $conexion=$c->conexion();

    $result=mysqli_query($conexion,$sql);

    return mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
  //funcion para ingresar personal
  public function insertarPersonal($datos){
    $c= new conectar();
    $conexion=$c->conexion();

    $sql="INSERT INTO personal(nombres,ape_pat,ape_mat,dni,celular,correo)
    values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')";

    return $result=mysqli_query($conexion,$sql);
  }
  //funcion para editar el perfil del personal
  public function editarpersonal($datos){
    $c= new conectar();
    $conexion=$c->conexion();

    $sql="UPDATE personal set nombres='$datos[0]',ape_pat='$datos[1]',ape_mat='$datos[2]',dni='$datos[3]',celular='$datos[4]',correo='$datos[5]'
    where id_personal=$datos[6]";
    return $result=mysqli_query($conexion,$sql);

  }
  //funcion para borrar del personal cambiandole el estado
  public function eliminarpersonal($id_personal){
    $c= new conectar();
    $conexion=$c->conexion();

    $sql="UPDATE personal set estado='0' where id_personal=$id_personal";
    return $result=mysqli_query($conexion,$sql);
  }
}


 ?>
