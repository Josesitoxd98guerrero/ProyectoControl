

  //iniciar clase para que acepte solo caracteres de tipo numerico
  $(".solo-numero").keydown(function(event) {
     if(event.shiftKey)
     {
          event.preventDefault();
     }

     if (event.keyCode == 46 || event.keyCode == 8)    {
     }
     else {
          if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                  event.preventDefault();
            }
          }
          else {
                if (event.keyCode < 96 || event.keyCode > 105) {
                    event.preventDefault();
                }
          }
        }
  });
  //funcion para abrir modal de estar seguro de eliminarpersonal
  function abrirmodaleliminar(id)
  {
    $("#modaleliminar").modal("show");
    $("#id_eliminar").val(id);
  }
  //funcion para eliminar personal cambiando su estado
  function eliminarpersonalestado()
  {
    datos = {"id_personal":$("#id_eliminar").val()};
    //haciendo consulta para cambiar estado a personal
    $.ajax({
        url: '../procesos/eliminarpersonal.php',
        type: 'post',
        data: datos,
        dataType: 'JSON',
        success: function(response){
            //validando si cambio el estado
            if(response[0].mensaje==1)
            {
              //recargando tabla
              $("#divtable").load(" #divtable");
              //cerrnando modal
              $("#modaleliminar").modal("hide");

            }

        }
    });
  }
  //funcion para cargar mensaje de div
  function mensajediv(data)
  {
    $("#"+data).fadeIn();
    setTimeout(function()
    {
      $("#"+data).fadeOut();
    }, 2000);
  }
  //funcion de guardar nuevo personal
  function guardarpersonal()
  {
    //validacion que el formulario este lleno por completo
    if($("#dni").val()=='' || $("#ape_pat").val()=='' || $("#ape_mat").val()==''||
    $("#nombres").val()=='' || $("#celular").val()=='' || $("#correo").val()=='')
    {
      //usando funcion para mander mensaje si faltan llenar datos
      mensajediv("mensajealert");
      return 0;
    }
    else
    {
    //validacion que el formulario tenga 8 caracteres
    if($("#dni").val().length<8)
    {
      //usando funcion para mander mensaje si faltan caracteres al dni
      mensajediv("dnicaracteres");
    }
    else
    {

    dni = {"dni_personal":$("#dni").val()};
    //validacion que no tenga duplicado de dni al guardar
    $.ajax({
        url: '../procesos/duplicadodni.php',
        type: 'post',
        data: dni,
        dataType: 'JSON',
        success: function(response){
            //validacion que no tenga duplicado de dni
            if(response[0].mensaje>=1)
            {
              //usando funcion para mander mensaje si hay duplicado de dni
              mensajediv("mensajedni");
              return 0;
            }
            else {
              datos = {
                "dni":$("#dni").val(),
                "ape_pat":$("#ape_pat").val(),
                "ape_mat":$("#ape_mat").val(),
                "nombres":$("#nombres").val(),
                "celular":$("#celular").val(),
                "correo":$("#correo").val()

              };
              //guardado de nuevo personal
              $.ajax({
                  url: '../procesos/insertarpersonal.php',
                  type: 'post',
                  data: datos,
                  dataType: 'JSON',
                  success: function(response){
                      console.log(response[0].mensaje);
                      //validando si se guardo el personal
                      if(response[0].mensaje==1)
                      {
                        $("#dni").val('');
                        $("#ape_pat").val('');
                        $("#ape_mat").val('');
                        $("#nombres").val('');
                        $("#celular").val('');
                        $("#correo").val('');
                        //mensaje si es que se llego a guardar el personal
                        mensajediv("mensajeguardado");
                      }
                      //recargando la tabla
                      $("#divtable").load(" #divtable");
                  }
              });
            }

        }
    });

  }

    }
  }
  //funcion de editar personal
  function editarpersonal()
  {
    //validacion que el formulario este lleno por completo
    if($("#dni_up").val()=='' || $("#ape_pat_up").val()=='' || $("#ape_mat_up").val()==''||
    $("#nombres_up").val()=='' || $("#celular_up").val()=='' || $("#correo_up").val()=='')
    {
      //usando funcion para mander mensaje si faltan llenar datos
      mensajediv("mensajealertedit");
      return 0;
    }
    else
    {
      //validacion que el formulario tenga 8 caracteres
    if($("#dni_up").val().length<8)
    {
      //usando funcion para mander mensaje si faltan caracteres al dni
      mensajediv("dnicaracteresedit");
    }
    else
    {

    dni = {"dni_personal":$("#dni_up").val(),"dni_val":$("#dni_up_val").val()};
    //validacion que no tenga duplicado de dni al editar
    $.ajax({
        url: '../procesos/duplicadodniedit.php',
        type: 'post',
        data: dni,
        dataType: 'JSON',
        success: function(response){
            //validacion que no tenga duplicado
            if(response[0].mensaje>=1)
            {
              //usando funcion para mander mensaje si hay duplicado de dni
              mensajediv("mensajedniedit");
              return 0;
            }
            else {
              datos = {
                "dni":$("#dni_up").val(),
                "ape_pat":$("#ape_pat_up").val(),
                "ape_mat":$("#ape_mat_up").val(),
                "nombres":$("#nombres_up").val(),
                "celular":$("#celular_up").val(),
                "correo":$("#correo_up").val(),
                "id_personal":$("#id_personal").val()

              };

              $.ajax({
                  url: '../procesos/editarpersonal.php',
                  type: 'post',
                  data: datos,
                  dataType: 'JSON',
                  success: function(response){
                      //console.log(response[0].mensaje);
                      $("#divtable").load(" #divtable");
                      //cerrando modal
                      $("#modalentrada").modal("hide");

                  }
              });
            }

        }
    });

    }

    }


  }


  //funcion para cargar los datos en el modal para poder editar
  function verificardatosedit(dni)
  {

    datos = {"dni_personal":dni};

    //haciendo consulta para llamar los datos de personal
    $.ajax({
        url: '../procesos/ajaxfile.php',
        type: 'post',
        data: datos,
        dataType: 'JSON',
        success: function(response){

            var len = response.length;

            //validando si trae datos
            if(len>0)
            {
              //llenando los datos en el formulario del modal
              $("#id_personal").val(response[0].id_personal);
              $("#dni_up").val(response[0].dni);dni_up_val
              $("#dni_up_val").val(response[0].dni);
              $("#ape_pat_up").val(response[0].ape_pat);
              $("#ape_mat_up").val(response[0].ape_mat);
              $("#nombres_up").val(response[0].nombres);
              $("#correo_up").val(response[0].correo);
              $("#celular_up").val(response[0].celular);

              //mostrando modal
              $("#modalentrada").modal("show");

            }

        }
    });


  }

  //funcion para verificar datos
  function verificardatos()
  {
    if($("#dni_personal").val()!='')
    {
    datos = {"dni_personal":$("#dni_personal").val()};

    console.log(datos);
    //haciendo consulta para llamar los datos de personal
    $.ajax({
        url: '../procesos/ajaxfile.php',
        type: 'post',
        data: datos,
        dataType: 'JSON',
        success: function(response){

            var len = response.length;

            //validando si trae datos
            if(len>0)
            {
              //llenando los datos en el formulario del modal
              $("#id_personal").val(response[0].id_personal);
              $("#dni").val(response[0].dni);
              $("#ape_pat").val(response[0].ape_pat);
              $("#ape_mat").val(response[0].ape_mat);
              $("#nombres").val(response[0].nombres);
              $("#correo").val(response[0].correo);
              $("#celular").val(response[0].celular);

              //validando si el boton de marcar salida se habilitara
              if(response[0].btnsalir==0)
              {
                $("#btnsalida").attr("disabled",false);
              }
              //validando si el boton de marcar entrada se habilitara
              if(response[0].btningresar==0)
              {
                $("#btnentrada").attr("disabled",false);
                $("#btnsalida").attr("disabled",true);
              }
              //validando si el boton de marcar entrada se desabilitara
              if(response[0].btningresar==1)
              {
                $("#btnentrada").attr("disabled",true);
              }
              //validando si el boton de marcar salida se desabilitara
              if(response[0].btnsalir==1)
              {
                $("#btnsalida").attr("disabled",true);
              }

              $("#modalentrada").modal("show");

            }
            else {
              //mostrando mensaje si el usuario no existe
              mensajediv("mensajealert");
              //recargando tabla
              $("#divtable").load(" #divtable");
            }

        }
    });

  }
  else {
    //mensaje si se esta enviando un dato vacio
    mensajediv("campovacio");
  }
  }

  //funcion para marcar la entrada del personal
  function MarcarEntrada()
  {
    datos = {"id_personal":$("#id_personal").val()};
    //haciendo envio de datos por ajax para marcar la entrada
    $.ajax({
        url: '../procesos/insertarentrada.php',
        type: 'post',
        data: datos,
        dataType: 'JSON',
        success: function(response){
            //cerrando modal
            $("#modalentrada").modal("hide");
            //mostrando mensaje si se marco la entrada correctamente
            mensajediv("mensajehoraentrada");
            //recargando tabla
            $("#divtable").load(" #divtable");
        }
    });
  }
  //funcion para marcar la entrada del personal
  function MarcarSalida()
  {
    datos = {"id_personal":$("#id_personal").val()};
    //haciendo envio de datos por ajax para marcar la salida
    $.ajax({
        url: '../procesos/marcarsalida.php',
        type: 'post',
        data: datos,
        dataType: 'JSON',
        success: function(response){
          //cerrando modal
            $("#modalentrada").modal("hide");
            //mostrando mensaje si se marco la salida correctamente
            mensajediv("mensajehorasalida");
            //recargando tabla
            $("#divtable").load(" #divtable");
        }
    });
  }
  //funcion para eliminar personal cambiando su estado
  function eliminarpersonal(id)
  {

    datos = {"id_personal":id};

    //haciendo consulta para llamar los datos de personal
    $.ajax({
        url: '../procesos/eliminarpersonal.php',
        type: 'post',
        data: datos,
        dataType: 'JSON',
        success: function(response){

            var len = response.length;

            //validando si trae datos
            if(len>0)
            {
              //llenando los datos en el formulario del modal
              $("#id_personal").val(response[0].id_personal);
              $("#dni_up").val(response[0].dni);dni_up_val
              $("#dni_up_val").val(response[0].dni);
              $("#ape_pat_up").val(response[0].ape_pat);
              $("#ape_mat_up").val(response[0].ape_mat);
              $("#nombres_up").val(response[0].nombres);
              $("#correo_up").val(response[0].correo);
              $("#celular_up").val(response[0].celular);

              //mostrando modal
              $("#modalentrada").modal("show");

            }

        }
    });


  }
