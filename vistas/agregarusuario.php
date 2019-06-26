<?php

require_once "../modelos/Conexion.php";
require_once "../modelos/Personal.php";
//haciendo consulta a la tabla personal
$query=("select * from personal where estado='1'");
//instanciando en un objeto la clase Personal
$obj= new Personal();
//guardando datos de la consulta en la variable $row2
$row2=$obj->mostrarpersonal($query);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <?php include('includes/scriptsdiseño.php'); ?>

  </head>
  <body>
    <div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-body">
            <div class="text-center">
              <h3>Esta seguro de eliminar?</h3>
              <input type="hidden" id="id_eliminar" value="">
              <button type="button" class="btn btn-rounded btn-primary" onclick="eliminarpersonalestado();">
              Aceptar</button>
              &nbsp;
              <button type="button" class="btn btn-rounded btn-danger" data-dismiss="modal" aria-hidden="true" name="button">
                Cancelar
              </button>
            </div>
    			</div>
    		</div>
    	</div>
    </div>
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
                        <input type="hidden" id="dni_up_val" class="form-control">
                        <input type="text" class="form-control solo-numero" id="dni_up" placeholder="DNI" maxlength="8" required>
                      </div>

                      <div class="form-group">
                        <label for="ape_pat">Apellido Paterno</label>
                        <input type="text" class="form-control" id="ape_pat_up" placeholder="Apellido Paterno" required>
                      </div>

                      <div class="form-group">
                        <label for="ape_mat">Apellido Materno</label>
                        <input type="text" class="form-control" id="ape_mat_up" placeholder="Apellido Materno" required>
                      </div>

                      <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" id="nombres_up" placeholder="Nombres" required>
                      </div>

                    <div class="form-group">
                      <label for="correo">Correo</label>
                      <input type="text" class="form-control" id="correo_up" placeholder="Correo" required>
                    </div>
                    <div class="form-group">
                      <label for="celular">Celular</label>
                      <input type="text" class="form-control solo-numero" id="celular_up" placeholder="Celular" maxlength="9" required>
                    </div>


                    <div class="form-group" id="mensajealertedit" style="display:none;">
                        <div class="alert alert-danger" role="alert">Llenar todos los campos</div>
                    </div>

                    <div class="form-group" id="mensajedniedit" style="display:none;">
                        <div class="alert alert-danger" role="alert">El dni ya esta en uso</div>
                    </div>

                    <div class="form-group" id="dnicaracteresedit" style="display:none;">
                        <div class="alert alert-danger" role="alert">El dni tiene 8 caracteres</div>
                    </div>
                  </form>
              </div>
              <div class="col-lg-2">

              </div>
            </div>

            <div class="text-center">
              <button type="button" class="btn btn-rounded btn-primary" onclick="editarpersonal();">
                <span class="glyphicon glyphicon-ok"></span> Editar</button>
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
          <div class="col-lg-3">

          </div>
          <div class="col-lg-5">
            <div class="panel panel-visible panel-default">
              <div class="panel-heading text-center">
                <h5>Personal</h5>
              </div>
              <div class="panel-body">
                <form>
                  <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="hidden" id="id_personal" class="form-control">
                    <input type="text" class="form-control solo-numero" id="dni" placeholder="DNI" maxlength="8" required>
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
                    <input type="text" class="form-control solo-numero" id="celular" placeholder="Celular" maxlength="9" required>
                  </div>
                  <div class="form-group" id="mensajealert" style="display:none;">
                      <div class="alert alert-danger" role="alert">Llenar todos los campos</div>
                  </div>
                  <div class="form-group" id="mensajedni" style="display:none;">
                      <div class="alert alert-danger" role="alert">El dni ya esta en uso</div>
                  </div>
                  <div class="form-group" id="dnicaracteres" style="display:none;">
                      <div class="alert alert-danger" role="alert">El dni tiene 8 caracteres</div>
                  </div>
                  <div class="form-group" id="mensajeguardado" style="display:none;">
                      <div class="alert alert-success" role="alert">Personal guardado correctamente</div>
                  </div>
                  <button type="button" class="btn btn-rounded btn-primary" onclick="guardarpersonal()">
                  <span class="glyphicon glyphicon-plus-sign"></span>&nbsp; Add</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-3">

          </div>
        </div>
        <br>

        <div class="panel panel-visible panel-default" id="divtable">
          <div class="panel-body">
            <div class="row">
            <h1>&nbsp;&nbsp;Personal</h1>
            <br>
              <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table id="tablacontrol" class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Nombres</th>
                      <th scope="col">Apellido Paterno</th>
                      <th scope="col">Apellido Materno</th>
                      <th scope="col">DNI</th>
                      <th scope="col">Correo</th>
                        <th scope="col" class="text-center">Ver</th>
                      <th scope="col" class="text-center">Editar</th>
                      <th scope="col" class="text-center">Eliminar</th>
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
                      <td><?php echo $row['correo'];?></td>
                      <td class="text-center"><a href="verhistorial.php?cod=<?php echo $row['id_personal']?>">
                        <button type="button" class="btn btn-rounded btn-info">
                          <span class="glyphicon glyphicon-eye-open"></span></button></a>
                      </td>
                      <td class="text-center">
                        <button type="button" class="btn btn-rounded btn-warning" onclick="verificardatosedit(<?php echo $row['dni'];?>)">
                          <span class="glyphicon glyphicon-pencil"></span></button>
                      </td>
                      <td class="text-center">
                        <button type="button" class="btn btn-rounded btn-danger" onclick="abrirmodaleliminar(<?php echo $row['id_personal'];?>)">
                          <span class="glyphicon glyphicon-trash"></span></button>
                      </td>
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
      <br>
      <br>
      <br>
      <br>
    </div>
  </section>
  </body>
</html>
<!-- Incluyendo las funciones que se necesitan -->
<script src="../estilos/funciones.js"></script>
