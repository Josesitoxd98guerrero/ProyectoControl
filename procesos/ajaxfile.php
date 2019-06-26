<?php
  require_once "../modelos/Conexion.php";
  require_once "../modelos/Metodos.php";

  $btningresar=0;
  $btnsalir=0;

  $dni_personal=$_POST['dni_personal'];

  $return_arr = array();
  //query para traer los datos del personal por su DNI
  $query = "SELECT * FROM personal where dni=$dni_personal and estado='1'";
  //instanciando en un objeto la clase Metodos
  $obj= new Metodos();
  //usando la funcion para mostrar datos
  $row2=$obj->mostrarDatos($query);
  //recorriendo si hay datos con la consulta hecha
  foreach ($row2 as $row) {
    //llenando datos
    $id_personal = $row['id_personal'];
    $nombres = $row['nombres'];
    $ape_pat = $row['ape_pat'];
    $ape_mat = $row['ape_mat'];
    $dni = $row['dni'];
    $correo = $row['correo'];
    $celular = $row['celular'];

    //validacion de botones
    $sqlingreso="SELECT id_personal FROM ingreso_salida where id_personal=$id_personal and fecha=CURDATE()";

    $sqlsalida="SELECT id_personal FROM ingreso_salida where id_personal=$id_personal and fecha=CURDATE() and not hora_salida=''";

    $btning=$obj->mostrarDatos($sqlingreso);
    $btnsal=$obj->mostrarDatos($sqlsalida);

    foreach ($btning as $key) {
      //devuelve 1 si ya hay un dato guardado de ese mismo dia con el mismo personal
      $btningresar=1;
    }

    foreach ($btnsal as $key) {
      //devuelve 1 si ya hay un dato guardado de ese mismo dia con el mismo personal en la hora de Salida
      //validando si ya se marco la hora de salida
      $btnsalir=1;
    }

    //fin de validacion de botones

    //guardando datos en un array
    $return_arr[] = array(
                        "id_personal" => $id_personal,
                        "nombres" => $nombres,
                        "ape_pat" => $ape_pat,
                        "ape_mat" => $ape_mat,
                        "dni" => $dni,
                        "correo" => $correo,
                        "celular" => $celular,
                        "btningresar" => $btningresar,
                        "btnsalir" => $btnsalir
                );

}



//retorna los valores del personal buscado con los validaciones de los botones en json
echo json_encode($return_arr);
