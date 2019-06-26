<?php

require_once "../modelos/Conexion.php";
require_once "../modelos/Metodos.php";
//haciendo consulta del personal que marco entrada o salida el dia actual
$query=("select I.id_personal,P.nombres,P.ape_pat,P.ape_mat,P.dni,I.fecha,I.hora_entrada,I.hora_salida from ingreso_salida I
right join personal P on P.id_personal=I.id_personal where I.fecha = curdate() and P.estado='1';");
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

    <?php include('includes/scriptsdiseño.php'); ?>

  </head>
  <body>
    <div class="modal fade" id="modalentrada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-md">
    		<div class="modal-content">
    			<div class="modal-header text-center">
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    				<span class="modal-dialog" id="myModalLabel">Personal</span>
    			</div>
    			<div class="modal-body">
            <div class="row">
              <div class="col-lg-2">

              </div>
              <div class="col-lg-8">
                <form>
                  <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="hidden" id="id_personal" class="form-control">
                    <input type="text" class="form-control" id="dni" placeholder="DNI" maxlength="8" required>
                  </div>
                  <div class="form-group">
                    <label for="ape_pat">Apellido Paterno</label>
                    <input type="text" class="form-control" id="ape_pat" placeholder="Apellido Paterno" required>
                  </div>
                  <div class="form-group">
                    <label for="ape_mat">Apellido Materno</label>
                    <input type="text" class="form-control" id="ape_mat" placeholder="Apellido Materno" required>
                  </div>
                  <div class="form-group">
                    <label for="nombres">Nombres</label>
                    <input type="text" class="form-control" id="nombres" placeholder="Nombres" required>
                  </div>
                  <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="text" class="form-control" id="correo" placeholder="Correo" required>
                  </div>
                  <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="text" class="form-control" id="celular" placeholder="Celular" maxlength="9" required>
                  </div>
                </form>
              </div>
              <div class="col-lg-2">

              </div>
            </div>
              <div class="text-center">
                <button type="button" class="btn btn-rounded btn-success" id="btnentrada" onclick="MarcarEntrada();">
                  <span class="glyphicon glyphicon-floppy-disk"></span> Entrada</button>
                <button type="button" class="btn btn-rounded btn-danger" id="btnsalida" onclick="MarcarSalida();">
                  <span class="glyphicon glyphicon-remove"></span> Salida</button>
              </div>
            </div>
    			</div>
    		</div>
    	</div>


      <!--incluyendo el navbar -->
      <?php include('includes/navbar.php'); ?>

     <section id="content">
       <div class="container">
         <div class="row">
           <div class="col-lg-8">
             <h2>Ingreso - Salida</h2>
             <div class="panel panel-visible panel-primary">
               <div class="panel-heading">Ingreso - Salida</div>
                <div class="panel-body">
                  <div class="row">
                    <form class="form-horizontal" role="form" method="post" id="registrar">
                      <div class="col-lg-8">
                        <div class="form-group">
                          <label for="inputStandard"  class="col-lg-2 control-label">DNI :</label>
                          <div class="col-lg-10">
                              <input type="text"  maxlength="8" id="dni_personal" class="form-control solo-numero" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <input type="button"  maxlength="8" class="btn btn-primary" value="Verificar" onclick="verificardatos()">
                      </div>
                    </form>
                  </div>
                  <div class="row" id="mensajealert" style="display:none;">
                  <br>
                    <div class="col-lg-10">
                      <div class="alert alert-danger" role="alert">El usuario no existe</div>
                    </div>
                    <div class="col-lg-2">

                    </div>
                  </div>
                  <div class="row" id="campovacio" style="display:none;">
                  <br>
                    <div class="col-lg-10">
                      <div class="alert alert-danger" role="alert">El campo esta vacio</div>
                    </div>
                    <div class="col-lg-2">

                    </div>
                  </div>
                  <div class="row" id="mensajehoraentrada" style="display:none;">
                    <br>
                      <div class="col-lg-10">
                        <div class="alert alert-success" role="alert">Grabado hora de entrada</div>
                      </div>
                    <div class="col-lg-2">

                    </div>
                  </div>
                  <div class="row" id="mensajehorasalida" style="display:none;">
                    <br>
                    <div class="col-lg-10">
                      <div class="alert alert-success" role="alert">Grabado hora de salida</div>
                    </div>
                    <div class="col-lg-2">

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-2 text-center">

            </div>
          </div>

          <div class="panel panel-visible panel-default" id="divtable">
            <div class="panel-body">
              <div class="row">
                <h1>&nbsp;&nbsp;Historial Diario</h1>
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
