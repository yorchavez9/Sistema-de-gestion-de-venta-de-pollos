$(document).ready(function () {

    
    /* ===========================================
    GUARDAR ROL
    =========================================== */
    $("#btn_guardar_rol").click(function (e) {

        e.preventDefault();

        var isValid = true;
    
        var nombre_rol = $("#nombre_rol").val();



      // Validar el nombre de categoríua
      if (nombre_rol === "") {
        $("#error_nombre_rol")
          .html("Por favor, ingrese el nombre")
          .addClass("text-danger");
        isValid = false;
      } else if (!isNaN(nombre_rol)) {
        $("#error_nombre_rol")
          .html("El nombre no puede contener números")
          .addClass("text-danger");
        isValid = false;
      } else {
        $("#error_nombre_rol").html("").removeClass("text-danger");
      }
      

  
      // Si el formulario es válido, envíalo
      if (isValid) {
        var datos = new FormData();
        datos.append("nombre_rol", nombre_rol);


        $.ajax({
          url: "ajax/Roles.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {
            var res = JSON.parse(respuesta);
  
            if (res === "ok") {

              $("#form_nuevo_rol")[0].reset();

              $("#modalNuevoRol").modal("hide");

              Swal.fire({
                title: "¡Correcto!",
                text: "El rol ha sido guardado",
                icon: "success",
              });

              mostrarRoles();

            } else {
              console.error("Error al cargar los datos.");
            }
          },
        });
      }
    });
  
    /* ===========================
    MOSTRANDO CATEGORIA
    =========================== */
    function mostrarRoles() {
      $.ajax({
          url: "ajax/Roles.ajax.php",
          type: "GET",
          dataType: "json",
          success: function (roles) {

              var tbody = $("#data_roles");

              tbody.empty();
  
              roles.forEach(function (rol, index) {
                var fila = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${rol.nombre_rol}</td>
                        <td>${rol.fecha_rol}</td>
                        <td class="text-center">
                            <a href="#" class="me-3 btnEditarRol" idRol="${rol.id_rol}" data-bs-toggle="modal" data-bs-target="#modalEditarRol">
                                <i class="text-warning fas fa-edit fa-lg"></i>
                            </a>
                            <a href="#" class="me-3 confirm-text btnEliminarRol" idRol="${rol.id_rol}">
                                <i class="text-danger fa fa-trash fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                `;
                  tbody.append(fila);
              });
  
              // Inicializar DataTables después de cargar los datos
              $('#tabla_rol').DataTable();
          },
          error: function (xhr, status, error) {
              console.error("Error al recuperar los proveedores:", error);
          },
      });
    }


    /*=============================================
    EDITAR EL ROL
    =============================================*/
    $("#tabla_rol").on("click", ".btnEditarRol", function () {

      var idRol = $(this).attr("idRol");
  
      var datos = new FormData();
      datos.append("idRol", idRol);
  
      $.ajax({
        url: "ajax/Roles.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

          $("#edit_id_rol").val(respuesta["id_rol"]);
          $("#edit_nombre_rol").val(respuesta["nombre_rol"]);

        },
      });
    });

  
    /*===========================================
    ACTUALIZAR CATEGORIA
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
          url: "ajax/Roles.ajax.php",
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

              mostrarRoles();

            } else {
              console.error("Error al cargar los datos.");
            }
          }
        });
      }
    });
  
    /*=============================================
      ELIMINAR ROL
      =============================================*/
    $("#tabla_rol").on("click",".btnEliminarRol",function (e) {
  
        e.preventDefault();
  
        var deleteIdRol = $(this).attr("idRol");
  
        var datos = new FormData();
        datos.append("deleteIdRol", deleteIdRol);
  
        Swal.fire({
          title: "¿Está seguro de borrar el rol?",
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
              url: "ajax/Roles.ajax.php",
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
                    text: "El rol ha sido eliminado",
                    icon: "success",
                  });
      
                  mostrarRoles();
  
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
    mostrarRoles();

  });



  