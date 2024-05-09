

$(document).ready(function () {

  /* =====================================
  VISTA PREVIA DE LA FOTO DEL TRABAJADOR
  ===================================== */

  $("#foto_t").change(function () {

    const file = this.files[0];

    if (file) {

      const reader = new FileReader();

      reader.onload = function (e) {

        $(".vista_previa_foto_trabajador").attr("src", e.target.result);

        $(".vista_previa_foto_trabajador").show();

      };

      reader.readAsDataURL(file);
    }

  });

  /* =====================================
  VISTA PREVIA DE PDF CV
  ===================================== */

  $("#cv_t").change(function () {
  
    $(".vista_previa_cv").show();

  });


  /* ===========================================
  GUARDAR TRABAJADOR
  =========================================== */

  $("#btn_guardar_trabajador").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var nombre = $("#nombre_t").val();
    var num_documento = $("#numero_documento_t").val();
    var telefono = $("#telefono_t").val();
    var correo = $("#correo_t").val();
    var foto = $("#foto_t").get(0).files[0];
    var cv = $("#cv_t").get(0).files[0];
    var tipo_pago = $("#tipo_pago_t").val();
    var num_cuenta = $("#numero_cuenta").val();


    /* VALIDANDO EL NOMBRE DEL TRABAJADOR */

    if (nombre == "") {

      $("#error_nombre_t").html("Por favor, ingrese el nombre completo").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_nombre_t").html("").removeClass("text-danger");

    }

    /* VALIDANDO EL NUMERO DE DOCUCUMENTO */

    if (num_documento == "" || num_documento.length < 8 || num_documento.length > 8 || isNaN(num_documento)) {

        $("#error_numero_documento_t").html("Por favor, ingrese un número de documento válido de exactamente 8 dígitos numéricos").addClass("text-danger");
        
        isValid = false;

    } else {

        $("#error_numero_documento_t").html("").removeClass("text-danger");

    }

     /* VALIDANDO EL TELEFONO */

     if (telefono == "") {

        $("#error_telefono_t").html("Por favor, ingrese el teléfono").addClass("text-danger");
  
        isValid = false;
  
      } else {
  
        $("#error_telefono_t").html("").removeClass("text-danger");
  
      }

     /* VALIDANDO EL CORREO */

     var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (correo == "") {

        $("#error_correo_t").html("Por favor, ingrese el correo").addClass("text-danger");

        isValid = false;

    } else if (!correoRegex.test(correo)) {

        $("#error_correo_t").html("Por favor, ingrese un correo válido").addClass("text-danger");

         isValid = false;

    } else {

        $("#error_correo_t").html("").removeClass("text-danger");

    }


    /* SI EL FORMULARIO ES VALIDO ENVIAR */

    if (isValid) {

      var datos = new FormData();

      datos.append("nombre", nombre);
      datos.append("num_documento", num_documento);
      datos.append("telefono", telefono);
      datos.append("correo", correo);
      datos.append("foto", foto);
      datos.append("cv", cv);
      datos.append("tipo_pago", tipo_pago);
      datos.append("num_cuenta", num_cuenta);


      $.ajax({
        url: "ajax/Trabajador.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

          var res = JSON.parse(respuesta);

          if (res === "ok") {

            $("#form_nuevo_trabajador")[0].reset();

            $(".vista_previa_foto_trabajador").attr("src", "");

            $('.vista_previa_cv').hide();

            $("#modalNuevoTrabajador").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "El trabajador ha sido registrado",
              icon: "success",
            });

            mostrarTrabajador();

          } else {

            console.error("La carga y guardado de la imagen ha fallado.");

          }

        },

      });

    }

  });

  /* ===========================
  MOSTRANDO USUARIOS
  =========================== */

  function mostrarTrabajador() {

    $.ajax({
      url: "ajax/Trabajador.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (trabajadores) {

        var tbody = $("#datos_trabajadores");

        var contador = 1;

        tbody.empty();

        trabajadores.forEach(function (trabajador) {

            trabajador.foto = trabajador.foto.substring(3);
            trabajador.cv = trabajador.cv.substring(3);

          var fila = `
                  <tr>
                      <td>
                        ${contador}
                      </td>
                      <td>
                          <a href="javascript:void(0);" class="product-img">
                              <img src="${trabajador.foto}" alt="${trabajador.foto}">
                          </a>
                      </td>
                      <td>${trabajador.nombre}</td>
                      <td>${trabajador.num_documento}</td>
                      <td>${trabajador.telefono}</td>
                      <td>${trabajador.correo}</td>
                      <td>
                        <a href="${trabajador.cv}" class="product-img" download>
                            <img src="vistas/pdf/pdf.png" alt="${trabajador.cv}">
                        </a>
                      </td>
                      <td>
                      ${trabajador.tipo_pago}
                      </td>
                      <td>
                          ${
                            trabajador.estado_trabajador != 0
                              ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idTrabajador="' + trabajador.id_trabajador + '" estadoTrabajador="0">Activado</button>'
                              : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idTrabajador="' + trabajador.id_trabajador + '" estadoTrabajador="1">Desactivado</button>'
                          }
                      </td>
                      
                      <td>

                          <a href="#" class="me-3 btnEditarTrabajador" idTrabajador="${trabajador.id_trabajador}" data-bs-toggle="modal" data-bs-target="#modalEditarTrabajador">
                              <i class="text-warning fas fa-edit fa-lg"></i>
                          </a>

                          <a href="#" class="me-3 btnVerTrabajador" idTrabajador="${trabajador.id_trabajador}" data-bs-toggle="modal" data-bs-target="#modalVerTrabajador">
                              <i class="text-primary fa fa-eye fa-lg"></i>
                          </a>

                          <a href="#" class="me-3 confirm-text btnEliminarTrabajador" idTrabajador="${trabajador.id_trabajador}" fotoTrabajador="${trabajador.foto}" cvTrabajador="${trabajador.cv}">
                              <i class="fa fa-trash fa-lg" style="color: #F52E2F"></i>
                          </a>

                      </td>

                  </tr>`;

          // Agregar la fila al tbody
          tbody.append(fila);
          
          contador++;
        });
        // Inicializar DataTables después de cargar los datos
        $("#tabla_trabajadores").DataTable();

      },
      error: function (xhr, status, error) {
        console.error("Error al recuperar los usuarios:", error);
      },
    });
  }

  /*=============================================
    ACTIVAR TRABAJADOR
    =============================================*/
    
  $("#tabla_trabajadores").on("click", ".btnActivar", function (e) {

    e.preventDefault();

    var idTrabajador = $(this).attr("idTrabajador");
    var activarTrabajador = $(this).attr("estadoTrabajador");

    var datos = new FormData();

    datos.append("activarId", idTrabajador);
    datos.append("activarTrabajador", activarTrabajador);

    $.ajax({
      url: "ajax/Trabajador.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {

        if (window.matchMedia("(max-width:767px)").matches) {

          swal({
            title: "El usuario ha sido actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!",
          }).then(function (result) {

            if (result.value) {
              window.location = "usuarios";
            }

          });

        }
      },

    });

    if (activarTrabajador == 0) {

      $(this)
        .removeClass("bg-lightgreen")
        .addClass("bg-lightred")
        .html("Desactivado");

      $(this).attr("estadoTrabajador", 1);

    } else {

      $(this)
        .removeClass("bg-lightred")
        .addClass("bg-lightgreen")
        .html("Activado");

      $(this).attr("estadoTrabajador", 0);

    }

  });

  /*=============================================
    EDITAR EL TRABAJADOR
    =============================================*/

  $("#tabla_trabajadores").on("click", ".btnEditarTrabajador", function (e) {

    e.preventDefault();

    var idTrabajador = $(this).attr("idTrabajador");

    var datos = new FormData();
    datos.append("idTrabajador", idTrabajador);

    $.ajax({
      url: "ajax/Trabajador.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {


        $("#edit_id_trabajador").val(respuesta["id_trabajador"]);
        $("#edit_nombre_t").val(respuesta["nombre"]);
        $("#edit_numero_documento_t").val(respuesta["num_documento"]);
        $("#edit_telefono_t").val(respuesta["telefono"]);
        $("#edit_correo_t").val(respuesta["correo"]);

        /* MOSTRANDO FOTO */

        var fotoTrabajador = respuesta["foto"].substring(3);

        if (respuesta["foto"] != "") {

          $(".edit_vista_previa_foto_trabajador").attr("src", fotoTrabajador);

        } else {

          $(".edit_vista_previa_foto_trabajador").attr("src","vistas/img/usuarios/default/anonymous.png");
        }

        $("#foto_actual_t").val(respuesta["foto"]);


        /* MOSTRANDO CV */


        if (respuesta["foto"] != "") {

            $('.edit_vista_previa_cv').show();

        } else {

            $('.edit_vista_previa_cv').show();
        }

        $("#cv_actual_t").val(respuesta["cv"]);

        $("#edit_tipo_pago_t").val(respuesta["tipo_pago"]);
        $("#edit_numero_cuenta").val(respuesta["num_cuenta"]);

      },
    });
  });

  /*=============================================
    MOSTRAR DETALLE DEL USUARIO
    =============================================*/

  $("#tabla_trabajadores").on("click", ".btnVerTrabajador", function (e) {

    e.preventDefault();

    var id_trabajador_ver = $(this).attr("idTrabajador");

    var datos = new FormData();

    datos.append("id_trabajador_ver", id_trabajador_ver);

    $.ajax({
      url: "ajax/Trabajador.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {



        $("#mostrar_nombre_trabajador").text(respuesta["nombre"]);
        $("#mostrar_numero_documento_trabajador").text(respuesta["num_documento"]);
        $("#mostrar_telefono_trabajador").text(respuesta["telefono"]);
        $("#mostrar_correo_trabajador").text(respuesta["correo"]);

        /* MOSTRAR FOTO */
        
        let fotoTrabajador = respuesta["foto"].substring(3);

        if (respuesta["foto"] != "") {

          $(".mostrar_foto_trabajador").attr("src", fotoTrabajador);

        } else {

          $(".mostrar_foto_trabajador").attr("src","vistas/img/usuarios/default/anonymous.png");

        }


        /* MOSTRAR CV */
        
        let cvTrabajador = respuesta["cv"].substring(3);

        if (respuesta["cv"] != "") {

          $(".mostrar_cv_trabajador").attr("src", "vistas/pdf/pdf.png");

          $(".descargar_cv_trabajador").attr("href", cvTrabajador);

        } else {

          $(".mostrar_cv_trabajador").attr("src","vistas/pdf/trabajador/pdf.png");

        }

        $("#mostrar_tipo_pago_trabajador").text(respuesta["tipo_pago"]);
        $("#mostrar_numero_cuenta_trabajador").text(respuesta["num_cuenta"]);
        
      },
    });
  });

  /*===========================================
    ACTUALIZAR EL TRABAJADOR
    =========================================== */

  $("#btn_actualizar_trabajador").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var edit_id_trabajador = $("#edit_id_trabajador").val();
    var edit_nombre_t = $("#edit_nombre_t").val();
    var edit_numero_documento_t = $("#edit_numero_documento_t").val();
    var edit_telefono_t = $("#edit_telefono_t").val();
    var edit_correo_t = $("#edit_correo_t").val();

    var edit_foto_t = $("#edit_foto_t").get(0).files[0];
    var foto_actual_t = $("#foto_actual_t").val();

    var edit_cv_t = $("#edit_cv_t").get(0).files[0];
    var cv_actual_t = $("#cv_actual_t").val();

    var edit_tipo_pago_t = $("#edit_tipo_pago_t").val();
    var edit_numero_cuenta = $("#edit_numero_cuenta").val();
 


    /* SI EL FORMULARIO ES CORRECTO ENVIARLO */

    if (isValid) {

      var datos = new FormData();

      datos.append("edit_id_trabajador", edit_id_trabajador);
      datos.append("edit_nombre_t", edit_nombre_t);
      datos.append("edit_numero_documento_t", edit_numero_documento_t);
      datos.append("edit_telefono_t", edit_telefono_t);
      datos.append("edit_correo_t", edit_correo_t);
      datos.append("edit_foto_t", edit_foto_t);
      datos.append("foto_actual_t", foto_actual_t);
      datos.append("edit_cv_t", edit_cv_t);
      datos.append("cv_actual_t", cv_actual_t);
      datos.append("edit_tipo_pago_t", edit_tipo_pago_t);
      datos.append("edit_numero_cuenta", edit_numero_cuenta);


      $.ajax({
        url: "ajax/Trabajador.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {


          var res = JSON.parse(respuesta);

          if (res === "ok") {

            $("#form_actualizar_trabajador")[0].reset();

            $(".edit_vista_previa_foto_trabajador").attr("src", "");

            $("#modalEditarTrabajador").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "El trabajador ha sido actualizado con éxito",
              icon: "success",
            });

            mostrarTrabajador();

          } else {

            console.error("Error al actualizar los datos");

          }

        },

      });

    }

  });

  /*=============================================
      ELIMINAR TRABAJADOR
      =============================================*/
  $("#tabla_trabajadores").on("click", ".btnEliminarTrabajador", function (e) {

    e.preventDefault();

    var deleleteIdTrabajador = $(this).attr("idTrabajador");
    var deleteFotoTrabajador = $(this).attr("fotoTrabajador");
    var deleteCvTrabajador = $(this).attr("cvTrabajador");


    var deleteRutaFoto = "../" + deleteFotoTrabajador;
    var deleteRutaCv = "../" + deleteCvTrabajador;

    var datos = new FormData();
    datos.append("deleleteIdTrabajador", deleleteIdTrabajador);
    datos.append("deleteRutaFoto", deleteRutaFoto);
    datos.append("deleteRutaCv", deleteRutaCv);

    Swal.fire({
      title: "¿Está seguro de borrar el trabajador?",
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
          url: "ajax/Trabajador.ajax.php",
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
                text: "El trabajador ha sido eliminado",
                icon: "success",
              });

              mostrarTrabajador();

            } else {

              console.error("Error al eliminar los datos");

            }
          },
        });
      }
    });
  });


  /* =====================================
  MSOTRANDO DATOS
  ===================================== */
  mostrarTrabajador();

});
