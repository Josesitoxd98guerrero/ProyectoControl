<?php
  require_once "../modelos/Conexion.php";
  require_once "../modelos/Personal.php";

  $mensaje='';

  $return_arr=array();
  //almacenando los datos que vienen del formulario para guardar personal
  $nombres=$_POST['nombres'];
  $ape_pat=$_POST['ape_pat'];
  $ape_mat=$_POST['ape_mat'];
  $dni=$_POST['dni'];
  $celular=$_POST['celular'];
  $correo=$_POST['correo'];
  //almacenando datos en un array para usar en la funcion de guardar personal
	$datos=array(
    $nombres,
    $ape_pat,
    $ape_mat,
    $dni,
    $celular,
    $correo
  );

  //instanciando en un objeto la clase Personal
	$obj= new Personal();
  //validando si es que llego a guardar el perfil del personal
	if($obj->insertarPersonal($datos)==1){
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
