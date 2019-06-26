<?php

require_once "../modelos/Conexion.php";
require_once "../modelos/Metodos.php";

$id_personal=$_GET['cod'];
//haciendo consulta del historial de entradas de personal
$query="select I.id_personal,P.nombres,P.ape_pat,P.ape_mat,P.dni,I.fecha,I.hora_entrada,I.hora_salida from ingreso_salida I
inner join personal P on P.id_personal=I.id_personal where I.id_personal=$id_personal and P.estado='1' order by fecha desc";
//instanciando en un objeto la clase Metodos
$obj= new Metodos();
//guardando datos de la consulta en la variable $row2
$row2=$obj->mostrarDatos($query);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- incluyendo los estilos y jquery que cargara -->
    <?php include('includes/scriptsdiseño.php'); ?>

  </head>
  <body>
  <!--incluyendo el navbar -->
  <?php include('includes/navbar.php'); ?>

  <section id="content">
      <br>
  <div class="container">
  <br>
    <div class="panel panel-visible panel-default" id="divtable">
      <div class="panel-body">
        <div class="row">
        <h1>&nbsp;&nbsp;Historial Detallado</h1>
        <br>
          <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table id="tablacontrol" class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellido Paterno</th>
                  <th scope="col">Apellido Materno</th>
                  <th scope="col">DNI</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Hora entrada</th>
                  <th scope="col">Hora salida</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($row2 as $row)
                {
                ?>
                <tr>
                  <td><?php echo $row['nombres'];?></td>
                  <td><?php echo $row['ape_pat'];?></td>
                  <td><?php echo $row['ape_mat'];?></td>
                  <td><?php echo $row['dni'];?></td>
                  <td><?php echo $row['fecha'];?></td>
                  <td><?php echo $row['hora_entrada'];?></td>
                  <td><?php echo $row['hora_salida'];?></td>
                </tr>

                <?php
                }
                 ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>
  </body>
</html>
<!-- Incluyendo las funciones que se necesitan -->
<script src="../estilos/funciones.js"></script>
