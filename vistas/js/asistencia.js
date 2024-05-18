$(document).ready(function () {

  /*=========================================
  SELECCION DE FECHA AUTOMATICO
  ===========================================*/

  var currentDate = new Date().toISOString().slice(0, 10);

  // Obtener la hora actual en formato HH:MM

  var currentTime = new Date().toTimeString().slice(0, 5);

  // Adelantar 8 horas a la hora actual para la hora de salida

  var dt = new Date();

  dt.setHours(dt.getHours() + 8);

  var futureTime = dt.toTimeString().slice(0, 5);

  // Establecer el valor del campo de fecha

  $('#fecha_asistencia_a').val(currentDate);

  // Establecer el valor del campo de hora de entrada

  $('#hora_entrada_a').val(currentTime);

  // Establecer el valor del campo de hora de salida adelantada 8 horas

  $('#hora_salida_a').val(futureTime);



  // Seleccionar un radio por fila

  $('input[type="radio"]').on('change', function () {

    var groupName = $(this).attr('name');

    $('input[name="' + groupName + '"]').each(function () {

      if ($(this).is(':checked')) {

        $(this).closest('tr').find('input[type="radio"]').prop('checked', false);

        $(this).prop('checked', true);

      }

    });

  });


  /*=========================================
  GUARDAR ASISTENCIA
  ===========================================*/

  $("#btn_guardar_asistencia").click(function (e) {


    e.preventDefault();

    var isValid = true;

    var fecha_asistencia_a = $("#fecha_asistencia_a").val();

    var hora_entrada_a = $("#hora_entrada_a").val();

    var hora_salida_a = $("#hora_salida_a").val();



    var valoresAsistencia = {};

    var datosAsistencia = [];

    $("#show_estado_asistencia tr").each(function () {

      var fila = $(this);

      var idTrabajador = fila.find("#id_trabajador_asistencia").val();

      var estado = fila.find("input[type='radio']:checked").val();

      var observacion = fila.find("input[type='text']").val();

      // Verificar si ya existe un registro para este trabajador

      if (valoresAsistencia[idTrabajador]) {

        // Si ya existe, actualizar el estado y la observación si es necesario

        if (estado) {

          valoresAsistencia[idTrabajador].estado = estado;
        }
        if (observacion) {

          valoresAsistencia[idTrabajador].observacion = observacion;
        }

      } else {

        // Si no existe, crear un nuevo registro

        var asistencia_data = {

          id_trabajador: idTrabajador,

          estado: estado || "Ausente", // Si no hay estado seleccionado, asumir "Ausente" o ajusta según tu lógica

          observacion: observacion || ""

        };

        valoresAsistencia[idTrabajador] = asistencia_data;

      }

    });

    // Convertir el objeto a un array

    for (var key in valoresAsistencia) {

      if (valoresAsistencia.hasOwnProperty(key)) {

        datosAsistencia.push(valoresAsistencia[key]);

      }

    }

    // Convertir el array a JSON

    var datosAsistenciaJSON = JSON.stringify(datosAsistencia);


    // Si el formulario es válido, envíalo

    if (isValid) {

      var datos = new FormData();

      datos.append("fecha_asistencia_a", fecha_asistencia_a);

      datos.append("hora_entrada_a", hora_entrada_a);

      datos.append("hora_salida_a", hora_salida_a);

      datos.append("datosAsistenciaJSON", datosAsistenciaJSON);


      $.ajax({
        url: "ajax/Asistencia.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {


          var res = JSON.parse(respuesta);

          if (res === "ok") {

            $("#form_nuevo_asistencia")[0].reset();

            $("#modalNuevoAsistencia").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "La asistencia ha sido guardado",
              icon: "success",
            });

            mostrarAsistencia();

          } else {

            console.error("La carga y guardado de la imagen ha fallado.");

          }

        },
        error: function (xhr, status, error) {

          console.error("Error al recuperar los usuarios:", error);

          console.error(xhr);

          console.error(status);

        },

      });

    }

  });


  // Función para formatear la fecha en "día de mes del año"

  function formatearFecha(fecha) {

    // Convertir la fecha a objeto Date

    var fechaObj = new Date(fecha);

    // Array de nombres de meses

    var meses = [
      "enero", "febrero", "marzo", "abril", "mayo", "junio",
      "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
    ];

    // Obtener día, mes y año

    var dia = fechaObj.getDate();

    var mes = fechaObj.getMonth(); // 0-based, por lo que enero es 0

    var anio = fechaObj.getFullYear();

    // Formatear la fecha

    var fechaFormateada = dia + " de " + meses[mes] + " del " + anio;

    return fechaFormateada;

  }



  /* ===========================
  MOSTRANDO USUARIOS
  =========================== */

  function mostrarAsistencia() {

    $.ajax({
      url: "ajax/Asistencia.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (asistencias) {

        var tbody = $("#data_mostrar_asistencias");

        tbody.empty();

        let fechasRegistradas = [];

        asistencias.forEach(function (asistencia, index) {

          // Verificar si la fecha ya está registrada

          if (!fechasRegistradas.includes(asistencia.fecha_asistencia)) {

            fechasRegistradas.push(asistencia.fecha_asistencia);

            // Construir la fila HTML

            let fila = `
                      <tr>

                        <td>${index + 1}</td>

                        <td>${asistencia.fecha_asistencia}</td>
                        
                        <td class="text-center">

                            <a href="#" class="me-3 btnEditarAsistencia" fechaAsistencia="${asistencia.fecha_asistencia}" data-bs-toggle="modal" data-bs-target="#modalEditarAsistencia">
                                <i class="text-warning fas fa-edit fa-lg"></i>
                            </a>

                            <a href="#" class="me-3 btnVerAsistencia" fechaAsistencia="${asistencia.fecha_asistencia}" data-bs-toggle="modal" data-bs-target="#modalVerAsistencia">
                                <i class="text-primary fa fa-eye fa-lg"></i>
                            </a>

                            <a href="#" class="me-3 confirm-text btnEliminarAsistencia" fechaAsistencia="${asistencia.fecha_asistencia}">
                                <i class="fa fa-trash fa-lg" style="color: #F52E2F"></i>
                            </a>

                        </td>

                      </tr>`;

            // Agregar la fila al tbody

            tbody.append(fila);
          }

        });


        // Inicializar DataTables después de cargar los datos

        $('#tabla_asistencia').DataTable();

      },

      error: function (xhr, status, error) {

        console.error("Error al recuperar los usuarios:", error);

        console.error(xhr);

        console.error(status);

      },

    });

  }


  /*=========================================
  EDITAR ASISTENCIA
  ===========================================*/

  $("#tabla_asistencia").on("click", ".btnEditarAsistencia", function (e) {

    e.preventDefault();

    var fechaAsistencia = $(this).attr("fechaAsistencia");

    var datos = new FormData();

    datos.append("fechaAsistencia", fechaAsistencia);

    $.ajax({
      url: "ajax/Asistencia.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        $("#edit_fecha_asistencia_a").val(respuesta["fecha_asistencia"]);

        $("#edit_hora_entrada_a").val(respuesta["hora_entrada"]);

        $("#edit_hora_salida_a").val(respuesta["hora_salida"]);

      },

    });

    $.ajax({
      url: "ajax/Asistencia.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        $("#edit_fecha_asistencia_a").val(respuesta["fecha_asistencia"]);

        $("#edit_hora_entrada_a").val(respuesta["hora_entrada"]);

        $("#edit_hora_salida_a").val(respuesta["hora_salida"]);

      },

    });

    $.ajax({

      url: "ajax/Lista.asistencia.ajax.php",

      method: "POST",

      data: datos,

      cache: false,

      contentType: false,

      processData: false,

      dataType: "json",

      success: function (detalleAsistencia) {


        var nuevaFila = "";


        let contador = 1;
        detalleAsistencia.forEach((trabajador) => {
          // Verificar si la clave 'asistencia' existe
          const estado = trabajador.estado || '';

          const nuevaFila = `
                          <tr>
                            <th scope="row">${contador}</th>
                            <td>
                                ${trabajador.nombre}
                                <input type="hidden" id="id_trabajador_asistencia${contador}" value="${trabajador.id_trabajador}">
                            </td>
                            <td class="text-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="asistencia${contador}" id="presente${contador}" value="Presente" ${estado === 'Presente' ? 'checked' : ''}>
                                    <label class="form-check-label" style="color: #28C76F" for="presente${contador}">Presente</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="asistencia${contador}" id="tarde${contador}" value="Tarde" ${estado === 'Tarde' ? 'checked' : ''}>
                                    <label class="form-check-label" style="color: #FF9F43" for="tarde${contador}">Tarde</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="asistencia${contador}" id="falta${contador}" value="Falta" ${estado === 'Falta' ? 'checked' : ''}>
                                    <label class="form-check-label" style="color: #FF4D4D" for="falta${contador}">Falta</label>
                                </div>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="observacion_asistencia${contador}" placeholder="Observación">
                            </td>
                        </tr>`;

          $("#edit_show_estado_asistencia").append(nuevaFila);

          contador++;

        });


      },
      error: function (respuesta) {

        console.log(respuesta);

      },

    });


  });

  /*=========================================
  ACTUALIZAR ASISTENCIA
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

            mostrarAsistencia();

          } else {

            console.error("Error al actualizar los datos");

          }

        },

      });

    }

  });


  /*=========================================
  VER ASISTENCIA
  ===========================================*/

  $("#tabla_asistencia").on("click", ".btnVerAsistencia", function (e) {

    e.preventDefault();

    var fechaAsistenciaVer = $(this).attr("fechaAsistencia");

    var fechaAsistenciaVerLista = $(this).attr("fechaAsistencia");

    var datos = new FormData();

    datos.append("fechaAsistenciaVer", fechaAsistenciaVer);

    $.ajax({
      url: "ajax/Asistencia.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        $("#ver_fecha_asistencia_a").val(respuesta["fecha_asistencia"]);

        $("#ver_hora_entrada_a").val(respuesta["hora_entrada"]);

        $("#ver_hora_salida_a").val(respuesta["hora_salida"]);

      },

    });


    var datas = new FormData();

    datas.append("fechaAsistenciaVerLista", fechaAsistenciaVerLista);

    $.ajax({

      url: "ajax/Asistencia.ajax.php",
      method: "POST",
      data: datas,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",

      success: function (listaAsistencia) {


        var nuevaFila = "";


        let contador = 1;

        listaAsistencia.forEach((trabajador) => {

          // Verificar si la clave 'asistencia' existe

          const estado = trabajador.estado || '';

          const nuevaFila = `
                          <tr>
                            <th scope="row">${contador}</th>
                            <td>
                                ${trabajador.nombre}
                                <input type="hidden" id="id_trabajador_asistencia${contador}" value="${trabajador.id_trabajador}">
                            </td>
                            <td class="text-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="asistencia${contador}" id="presente${contador}" value="Presente" ${estado === 'Presente' ? 'checked' : ''}>
                                    <label class="form-check-label" style="color: #28C76F" for="presente${contador}">Presente</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="asistencia${contador}" id="tarde${contador}" value="Tarde" ${estado === 'Tarde' ? 'checked' : ''}>
                                    <label class="form-check-label" style="color: #FF9F43" for="tarde${contador}">Tarde</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="asistencia${contador}" id="falta${contador}" value="Falta" ${estado === 'Falta' ? 'checked' : ''}>
                                    <label class="form-check-label" style="color: #FF4D4D" for="falta${contador}">Falta</label>
                                </div>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="observacion_asistencia${contador}" placeholder="Observación">
                            </td>
                        </tr>`;

          $("#ver_show_estado_asistencia").append(nuevaFila);

          contador++;

        });


      },
      error: function (respuesta) {

        console.log(respuesta);

      },

    });


  });

  /*=========================================
  ELIMINAR ASISTENCIA
  ===========================================*/

  $("#tabla_asistencia").on("click", ".btnEliminarAsistencia", function (e) {

    e.preventDefault();

    var fechaAsistenciaDelete = $(this).attr("fechaAsistencia");

    var datos = new FormData();

    datos.append("fechaAsistenciaDelete", fechaAsistenciaDelete);

    Swal.fire({
      title: "¿Está seguro de borrar la asistencia?",
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
          url: "ajax/Asistencia.ajax.php",
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
                text: "La asistencia ha sido eliminado",
                icon: "success",
              });

              mostrarAsistencia();

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
  LIMPIAR MODALES
  ===========================================*/
  
  $('.close_modal_asistencia').click(function () {

    $('#form_editar_asistencia')[0].reset();

    $('#form_ver_asistencia')[0].reset();

    $('#edit_show_estado_asistencia').empty();

    $('#ver_show_estado_asistencia').empty();

  });

  /*=========================================
  MOSTRADO VACACIONES
  ===========================================*/

  mostrarAsistencia();
});
