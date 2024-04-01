$(document).ready(function () {

    /* ===========================================
    GUARDAR PERMISO
    =========================================== */
    $("#btn_guardar_permiso").click(function (e) {

        e.preventDefault();

        var isValid = true;
    
        var id_usuario = $("#id_usuario_permiso").val();

        var permisos = [];
        $(".valor_rol:checked").each(function(){
            permisos.push($(this).val());
        });


      // Validar el nombre de categoríua
      if (id_usuario === "" || id_usuario === null) {
        $("#error_id_usuario_permiso")
          .html("Por favor, selecione el usuario")
          .addClass("text-danger");
        isValid = false;
      } else {
        $("#error_id_usuario_permiso").html("").removeClass("text-danger");
      }

      // Validar permisos
        if (permisos.length === 0) {
            $("#error_id_rol_permiso")
                .html("Por favor, seleccione al menos un permiso")
                .addClass("text-danger");
            isValid = false;
        } else {
            $("#error_id_rol_permiso").html("").removeClass("text-danger");
        }
      

  
      // Si el formulario es válido, envíalo
      if (isValid) {
        
        var datos = new FormData();
        datos.append("id_usuario", id_usuario);
        datos.append("permisos", permisos);

        $.ajax({
          url: "ajax/Usuario.permiso.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {
            var res = JSON.parse(respuesta);
  
            if (res === "ok") {

              $("#form_nuevo_permisos")[0].reset();

              $("#modalNuevoPermisoUsuario").modal("hide");

              Swal.fire({
                title: "¡Correcto!",
                text: "Los permisos han sido guardados",
                icon: "success",
              });

              mostrarPermisos();

            } else {
              console.error(res);
            }
          },
        });
      }
    });
  
    /* ===========================
    MOSTRANDO PERMISO
    =========================== */
    function mostrarPermisos() {
      $.ajax({
        url: "ajax/Usuario.permiso.ajax.php",
        type: "GET",
        dataType: "json",
        success: function (permisos) {
          var tbody = $("#data_permisos");

          tbody.empty();

          var idsProcesados = {};

          permisos.forEach(function (permiso, index) {
            // Verificar si el id de usuario ya ha sido procesado
            if (!idsProcesados[permiso.id_usuario]) {
              var rolesUsuario = "";
              permisos.forEach(function (element) {
                if (element.id_usuario === permiso.id_usuario) {
                  rolesUsuario += `<span class="badge bg-primary mx-1">${element.nombre_rol}</span>`;
                }
              });

              var fila = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${permiso.nombre_usuario}</td>
                            <td>${rolesUsuario}</td>
                            <td class="text-center">
                                <a href="#" class="me-3 btnEditarUsuarioPermiso" idPermiso="${permiso.id_usuario}" data-bs-toggle="modal" data-bs-target="#modalEditarUsuarioPermiso">
                                    <i class="text-warning fas fa-edit fa-lg"></i>
                                </a>
                                <a href="#" class="me-3 confirm-text btnEliminarUsuarioPermiso" idPermiso="${permiso.id_usuario}">
                                    <i class="text-danger fa fa-trash fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                    `;
              // Agregar el id de usuario al objeto de ids procesados
              idsProcesados[permiso.id_usuario] = true;
              tbody.append(fila);
            }
          });

          // Inicializar DataTables después de cargar los datos
          $("#tabla_permiso").DataTable();
        },
        error: function (xhr, status, error) {
          console.error("Error al recuperar los proveedores:", error);
        },
      });
    }


    /*=============================================
    EDITAR USUARIO PERMISO
    =============================================*/
    $("#tabla_permiso").on("click", ".btnEditarUsuarioPermiso", function () {


      var idPermiso = $(this).attr("idPermiso");

  
      var datos = new FormData();
      datos.append("idPermiso", idPermiso);

  
      $.ajax({
        url: "ajax/Usuario.permiso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

          console.log(respuesta);

        },
      });
    });

  
    /*===========================================
    ACTUALIZAR USUARIO PERMISO
    =========================================== */
    $("#btn_actualizar_rol").click(function (e) {

      e.preventDefault();
  
  
      var isValid = true;
  
      var edit_id_rol = $("#edit_id_rol").val();
      var edit_nombre_rol = $("#edit_nombre_rol").val();

  
     // Validar el nombre de categoríua
     if (edit_nombre_rol === "") {
        $("#edit_error_nombre_rol")
          .html("Por favor, ingrese el nombre")
          .addClass("text-danger");
        isValid = false;
      } else if (!isNaN(edit_nombre_rol)) {
        $("#edit_error_nombre_rol")
          .html("El nombre no puede contener números")
          .addClass("text-danger");
        isValid = false;
      } else {
        $("#edit_error_nombre_rol").html("").removeClass("text-danger");
      }
      
      

      if (isValid) {
        var datos = new FormData();
        datos.append("edit_id_rol", edit_id_rol);
        datos.append("edit_nombre_rol", edit_nombre_rol);



        $.ajax({
          url: "ajax/Usuario.permiso.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {
            var res = JSON.parse(respuesta);
  
            if (res === "ok") {

              $("#form_actualizar_rol")[0].reset();

              $("#modalEditarRol").modal("hide");

              Swal.fire({
                title: "¡Correcto!",
                text: "El ha sido actualizado",
                icon: "success",
              });

              mostrarPermisos();

            } else {
              console.error("Error al cargar los datos.");
            }
          }
        });
      }
    });
  
    /*=============================================
      ELIMINAR USUARIO PERMISO
      =============================================*/
    $("#tabla_permiso").on("click",".btnEliminarUsuarioPermiso",function (e) {
  
        e.preventDefault();
  
        var idDeletePermiso = $(this).attr("idPermiso");
  
        var datos = new FormData();
        datos.append("idDeletePermiso", idDeletePermiso);
  
        Swal.fire({
          title: "¿Está seguro de borrar el los permisos?",
          text: "¡Si no lo está puede cancelar la accíón!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#0084FF",
          cancelButtonColor: "#F1666D",
          cancelButtonText: "Cancelar",
          confirmButtonText: "Si, borrar!",
        }).then(function (result) {
          if (result.value) {
            $.ajax({
              url: "ajax/Usuario.permiso.ajax.php",
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
                    text: "Los permisos han sido eliminados",
                    icon: "success",
                  });
      
                  mostrarPermisos();
  
                } else {
  
                  console.error("Error al eliminar los datos");
  
                }
              }
          });
          
          }
        });
      }
    );
  
    /* =====================================
    MOSTRANDO DATOS
    ===================================== */
    mostrarPermisos();

});


