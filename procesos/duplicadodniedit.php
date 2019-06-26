<?php
  require_once "../modelos/Conexion.php";
  require_once "../modelos/Personal.php";


  $mensaje=0;

  $dni_personal=$_POST['dni_personal'];
  $dni_val=$_POST['dni_val'];

  $return_arr = array();
  //query para validar si hay un duplicado de DNI al editar un personal
  $query = "SELECT dni FROM personal where dni='$dni_personal' and not dni='$dni_val'";
  //instanciando en un objeto la clase Metodos
  $obj= new Personal();
  //usando la funcion para mostrar datos
  $row2=$obj->mostrarpersonal($query);
  //recorriendo si hay un personal con ese mismo DNI
  foreach ($row2 as $row) {
  //devuelve 1 si hay un personal con ese mismo DNI
  $mensaje=1;

  }

  $return_arr[] = array(
                      "mensaje" => $mensaje
              );

  // retornando respuesta en json
  echo json_encode($return_arr);
