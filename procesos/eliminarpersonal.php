<?php
  require_once "../modelos/Conexion.php";
  require_once "../modelos/Personal.php";

  $mensaje='';

  $return_arr=array();
  //almacenando los datos que vienen del formulario para editar perfil
  $id_personal=$_POST['id_personal'];
  //instanciando en un objeto la clase Personal
	$obj= new Personal();
  //validando si es que llego a actualizar estado del personal
	if($obj->eliminarpersonal($id_personal)==1){
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
