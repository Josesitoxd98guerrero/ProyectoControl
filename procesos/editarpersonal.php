<?php
  require_once "../modelos/Conexion.php";
  require_once "../modelos/Personal.php";

  $mensaje='';

  $return_arr=array();
  //almacenando los datos que vienen del formulario para editar perfil
  $nombres=$_POST['nombres'];
  $ape_pat=$_POST['ape_pat'];
  $ape_mat=$_POST['ape_mat'];
  $dni=$_POST['dni'];
  $celular=$_POST['celular'];
  $correo=$_POST['correo'];
  $id_personal=$_POST['id_personal'];
  //almacenando datos en un array para usar en la funcion de editar perfil
	$datos=array(
    $nombres,
    $ape_pat,
    $ape_mat,
    $dni,
    $celular,
    $correo,
    $id_personal
  );

  //instanciando en un objeto la clase Personal
	$obj= new Personal();
  //validando si es que llego a editar el perfil del personal
	if($obj->editarpersonal($datos)==1){
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
