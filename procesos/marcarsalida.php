<?php

  require_once "../modelos/Conexion.php";
  require_once "../modelos/Metodos.php";

  $mensaje='';

  $return_arr=array();

  $id_personal=$_POST['id_personal'];
  //guardando el id del personal en un array para hacer uso de la funcion de marcar la salida
	$datos=array($id_personal);
  //instanciando en un objeto la clase Personal
	$obj= new Metodos();
  //validando si es que llego a marcar la salida
  if($obj->marcarsalida($datos)==1){
    //devuelve 1 si es verdadero
		$mensaje=1;
	}else{
    //devuelve 0 si es falso
		$mensaje=0;
	}

  $return_arr[] = array("mensaje" => $mensaje);
  //retornando respuesta en un json
  echo json_encode($return_arr);

 ?>
