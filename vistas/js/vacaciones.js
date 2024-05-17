$(document).ready(function () {


  /*=========================================
  GUARDAR VACACIONES
  ===========================================*/
  $("#btn_guardar_vacacion").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var id_trabajador = $("#id_trabajador_v").val();

    var fecha_inicio = $("#fecha_inicio_v").val();

    var fecha_fin = $("#fecha_fin_v").val();


    // Validando selecciond de trabajador

    if (id_trabajador == null || id_trabajador == "") {

      $("#error_id_trabajador_v").html("Por favor, seleccione el trabajador").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_id_trabajador_v").html("").removeClass("text-danger");

    }

    // Validando la fecha de inicio

    if (fecha_inicio == "") {

      $("#error_fecha_inicio_v").html("Por favor, seleccione la fecha").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_fecha_inicio_v").html("").removeClass("text-danger");

    }

    // Validando la fecha de fin

    if (fecha_fin == "") {

      $("#error_fecha_fin_v").html("Por favor, seleccione la fecha").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_fecha_fin_v").html("").removeClass("text-danger");

    }


    // Si el formulario es válido, envíalo

    if (isValid) {

      var datos = new FormData();

      datos.append("id_trabajador", id_trabajador);

      datos.append("fecha_inicio", fecha_inicio);

      datos.append("fecha_fin", fecha_fin);


      $.ajax({
        url: "ajax/Vacaciones.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

          var res = JSON.parse(respuesta);

          if (res === "ok") {

            $("#form_nuevo_vacaciones")[0].reset();

            $("#modalNuevoVacaciones").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "Vacacion del trabrajador creado",
              icon: "success",
            });

            mostrarVacaciones();

          } else {
            console.error("La carga y guardado de la imagen ha fallado.");
          }

        },

      });

    }

  });

  /*=========================================
  MOSTRANDO VACACIONES
  ===========================================*/
  function mostrarVacaciones() {

    $.ajax({
      url: "ajax/Vacaciones.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (vacaciones) {

        var today = new Date();

        var year = today.getFullYear();

        var month = ('0' + (today.getMonth() + 1)).slice(-2);

        var day = ('0' + today.getDate()).slice(-2);

        var fecha_actual = year + '-' + month + '-' + day;


        var tbody = $("#data_mostrar_vacaciones");

        tbody.empty();

        vacaciones.forEach(function (vacacion) {

          let fechaInicio = vacacion.fecha_inicio;

          let fechaFin = vacacion.fecha_fin;

          if(fechaInicio == fecha_actual && fecha_actual <= fechaFin){

            var idVacacion = vacacion.id_vacacion;

            var estadoVacacion = 1;

            var datos = new FormData();

            datos.append("activarId", idVacacion);

            datos.append("activarVacacion", estadoVacacion);

            $.ajax({

              url: "ajax/Vacaciones.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              success: function (respuesta) {

              },

            });

          }else{

            var idVacacion = vacacion.id_vacacion;

            var estadoVacacion = 0;

            var datos = new FormData();

            datos.append("activarId", idVacacion);

            datos.append("activarVacacion", estadoVacacion);

            $.ajax({

              url: "ajax/Vacaciones.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              success: function (respuesta) {

              },

            });

          }


          var fila = `
                  <tr>
                      <td>
                         
                      </td>
                      <td>${vacacion.nombre}</td>
                      <td>${vacacion.fecha_inicio}</td>
                      <td>${vacacion.fecha_fin}</td>

  
                      <td>
                          ${vacacion.estado_vacion != 0 ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idVacacion="' + vacacion.id_vacacion + '" estadoVacacion="0">En vacaciones</button>'
                                                        : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idVacacion="' + vacacion.id_vacacion + '" estadoVacacion="1">Desactivado</button>'
                          }
                      </td>
                      
                      <td class="text-center">

                          <a href="#" class="me-3 btnEditarVacacion" idVacacion="${vacacion.id_vacacion}" data-bs-toggle="modal" data-bs-target="#modalEditarVacaciones">
                              <i class="text-warning fas fa-edit fa-lg"></i>
                          </a>

                          <a href="#" class="me-3 confirm-text btnEliminarVacacion" idVacacion="${vacacion.id_vacacion}">
                              <i class="fa fa-trash fa-lg" style="color: #F52E2F"></i>
                          </a>

                      </td>

                  </tr>`;


          // Agregar la fila al tbody
          tbody.append(fila);
        });
        // Inicializar DataTables después de cargar los datos
        $('#tabla_vacaciones').DataTable();
      },
      error: function (xhr, status, error) {
        console.error("Error al recuperar los usuarios:", error);
        console.error(xhr);
        console.error(status);
      },
    });
  }


  /*=========================================
  EDITAR VACACIONES
  ===========================================*/
  $("#tabla_vacaciones").on("click", ".btnEditarVacacion", function (e) {

    e.preventDefault();

    var idVacacion = $(this).attr("idVacacion");

    var datos = new FormData();

    datos.append("idVacacion", idVacacion);

    $.ajax({
      url: "ajax/Vacaciones.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {


        $("#edit_id_vacaciones").val(respuesta["id_vacacion"]);

        $("#edit_id_trabajador_v").val(respuesta["id_trabajador"]);

        $("#edit_fecha_inicio_v").val(respuesta["fecha_inicio"]);

        $("#edit_fecha_fin_v").val(respuesta["fecha_fin"]);

      },

    });

  });


  /*=========================================
  ACTUALIZAR VACACIONES
  ===========================================*/
  $("#btn_actualizar_vacacion").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var edit_id_vacaciones = $("#edit_id_vacaciones").val();
    var edit_id_trabajador_v = $("#edit_id_trabajador_v").val();
    var edit_fecha_inicio_v = $("#edit_fecha_inicio_v").val();
    var edit_fecha_fin_v = $("#edit_fecha_fin_v").val();

    // Validando selecciond de trabajador

    if (edit_id_trabajador_v == null || edit_id_trabajador_v == "") {

      $("#edit_error_id_trabajador_v").html("Por favor, seleccione el trabajador").addClass("text-danger");

      isValid = false;

    } else {

      $("#edit_error_id_trabajador_v").html("").removeClass("text-danger");

    }

    // Validando la fecha de inicio

    if (edit_fecha_inicio_v == "") {

      $("#edit_error_fecha_inicio_v").html("Por favor, seleccione la fecha").addClass("text-danger");

      isValid = false;

    } else {

      $("#edit_error_fecha_inicio_v").html("").removeClass("text-danger");

    }

    // Validando la fecha de fin

    if (edit_fecha_fin_v == "") {

      $("#edit_error_fecha_fin_v").html("Por favor, seleccione la fecha").addClass("text-danger");

      isValid = false;

    } else {

      $("#edit_error_fecha_fin_v").html("").removeClass("text-danger");

    }


    // Si el formulario es válido, envíalo
    if (isValid) {

      var datos = new FormData();

      datos.append("edit_id_vacaciones", edit_id_vacaciones);
      datos.append("edit_id_trabajador_v", edit_id_trabajador_v);
      datos.append("edit_fecha_inicio_v", edit_fecha_inicio_v);
      datos.append("edit_fecha_fin_v", edit_fecha_fin_v);

      $.ajax({
        url: "ajax/Vacaciones.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

          var res = JSON.parse(respuesta);

          if (res === "ok") {

            $("#form_actualizar_vacaciones")[0].reset();

            $("#modalEditarVacaciones").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "Vacacion actualizado con éxito",
              icon: "success",
            });

            mostrarVacaciones();
          } else {
            console.error("Error al actualizar los datos");
          }
        },
      });
    }
  });

  /*=========================================
  ELIMINAR VACACIONES
  ===========================================*/
  $("#tabla_vacaciones").on("click", ".btnEliminarVacacion", function (e) {

    e.preventDefault();

    var idVacacionDelete = $(this).attr("idVacacion");

    var datos = new FormData();

    datos.append("idVacacionDelete", idVacacionDelete);

    Swal.fire({
      title: "¿Está seguro de borrar la vacación?",
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar!",
    }).then(function (result) {

      if (result.value) {

        $.ajax({
          url: "ajax/Vacaciones.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {

            var res = JSON.parse(respuesta);

            if (res === "ok") {

              Swal.fire({
                title: "¡Eliminado!",
                text: "La vacación ha sido eliminado",
                icon: "success",
              });

              mostrarVacaciones();

            } else {

              console.error("Error al eliminar los datos");

            }
          }

        });

      }

    });
  }

  );


  /*=========================================
  MOSTRADO VACACIONES
  ===========================================*/
  mostrarVacaciones();
});
