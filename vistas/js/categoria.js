$(document).ready(function () {

  
    /* ===========================================
    GUARDAR CATEGORIA
    =========================================== */
    $("#btn_guardar_categoria").click(function (e) {

        e.preventDefault();

        var isValid = true;
    
        var nombre_categoria = $("#nombre_categoria").val();
        var descripcion_categoria = $("#descripcion_categoria").val();


      // Validar el nombre de categoríua
      if (nombre_categoria === "") {
        $("#error_nombre_categoria")
          .html("Por favor, ingrese el nombre")
          .addClass("text-danger");
        isValid = false;
      } else if (!isNaN(nombre_categoria)) {
        $("#error_nombre_categoria")
          .html("El nombre no puede contener números")
          .addClass("text-danger");
        isValid = false;
      } else {
        $("#error_nombre_categoria").html("").removeClass("text-danger");
      }
      


      // Validar el descripcion de categoria
      if (descripcion_categoria === "") {
        $("#error_descripcion_categoria")
          .html("Por favor, ingrese la descripción")
          .addClass("text-danger");
        isValid = false;
      } else if (!isNaN(descripcion_categoria)) {
        $("#error_descripcion_categoria")
          .html("La descripción no puede contener números")
          .addClass("text-danger");
        isValid = false;
      } else {
        $("#error_descripcion_categoria").html("").removeClass("text-danger");
      }
      


  
      // Si el formulario es válido, envíalo
      if (isValid) {
        var datos = new FormData();
        datos.append("nombre_categoria", nombre_categoria);
        datos.append("descripcion_categoria", descripcion_categoria);

  
        $.ajax({
          url: "ajax/Categoria.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {
            var res = JSON.parse(respuesta);
  
            if (res === "ok") {

              $("#form_nuevo_categoria")[0].reset();

              $("#modalNuevoCategoria").modal("hide");

              Swal.fire({
                title: "¡Correcto!",
                text: "La categoría ha sido guardado",
                icon: "success",
              });

              mostrarCategorias();

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
    function mostrarCategorias() {
      $.ajax({
          url: "ajax/Categoria.ajax.php",
          type: "GET",
          dataType: "json",
          success: function (categorias) {

              var tbody = $("#dataCategorias");
              tbody.empty();
  
              categorias.forEach(function (categoria, index) {
                var fila = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${categoria.nombre_categoria}</td>
                        <td>${categoria.descripcion}</td>
                        <td>${categoria.fecha}</td>
                        <td class="text-center">
                            <a href="#" class="me-3 btnEditarCategoria" idCategoria="${categoria.id_categoria}" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria">
                                <i class="text-warning fas fa-edit fa-lg"></i>
                            </a>
                            <a href="#" class="me-3 confirm-text btnEliminarCategoria" idCategoria="${categoria.id_categoria}">
                                <i class="text-danger fa fa-trash fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                `;
                  tbody.append(fila);
              });
  
              // Inicializar DataTables después de cargar los datos
              $('#tabla_categoria').DataTable();
          },
          error: function (xhr, status, error) {
              console.error("Error al recuperar los proveedores:", error);
          },
      });
    }


    /*=============================================
    EDITAR EL CATEGORIA
    =============================================*/
    $("#tabla_categoria").on("click", ".btnEditarCategoria", function () {

      var idCategoria = $(this).attr("idCategoria");
  
      var datos = new FormData();
      datos.append("idCategoria", idCategoria);
  
      $.ajax({
        url: "ajax/Categoria.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

          $("#edit_id_categoria").val(respuesta["id_categoria"]);
          $("#edit_nombre_categoria").val(respuesta["nombre_categoria"]);
          $("#edit_descripcion_categoria").val(respuesta["descripcion"]);

        },
      });
    });

  
    /*===========================================
    ACTUALIZAR CATEGORIA
    =========================================== */
    $("#btn_actualizar_categoria").click(function (e) {

      e.preventDefault();
  
  
      var isValid = true;
  
      var edit_id_categoria = $("#edit_id_categoria").val();
      var edit_nombre_categoria = $("#edit_nombre_categoria").val();
      var edit_descripcion_categoria = $("#edit_descripcion_categoria").val();
  
     // Validar el nombre de categoríua
     if (edit_nombre_categoria === "") {
        $("#edit_error_nombre_categoria")
          .html("Por favor, ingrese el nombre")
          .addClass("text-danger");
        isValid = false;
      } else if (!isNaN(edit_nombre_categoria)) {
        $("#edit_error_nombre_categoria")
          .html("El nombre no puede contener números")
          .addClass("text-danger");
        isValid = false;
      } else {
        $("#edit_error_nombre_categoria").html("").removeClass("text-danger");
      }
      


      // Validar el descripcion de categoria
      if (edit_descripcion_categoria === "") {
        $("#edit_error_descripcion_categoria")
          .html("Por favor, ingrese la descripción")
          .addClass("text-danger");
        isValid = false;
      } else if (!isNaN(edit_descripcion_categoria)) {
        $("#edit_error_descripcion_categoria")
          .html("La descripción no puede contener números")
          .addClass("text-danger");
        isValid = false;
      } else {
        $("#edit_error_descripcion_categoria").html("").removeClass("text-danger");
      }
      
      

      if (isValid) {
        var datos = new FormData();
        datos.append("edit_id_categoria", edit_id_categoria);
        datos.append("edit_nombre_categoria", edit_nombre_categoria);
        datos.append("edit_descripcion_categoria", edit_descripcion_categoria);


        $.ajax({
          url: "ajax/Categoria.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {
            var res = JSON.parse(respuesta);
  
            if (res === "ok") {
              $("#form_actualizar_categoria")[0].reset();

              $("#modalEditarCategoria").modal("hide");

              Swal.fire({
                title: "¡Correcto!",
                text: "La categoría ha sido actualizado",
                icon: "success",
              });

              mostrarCategorias();

            } else {
              console.error("Error al cargar los datos.");
            }
          }
        });
      }
    });
  
    /*=============================================
      ELIMINAR CATEGORIA
      =============================================*/
    $("#tabla_categoria").on("click",".btnEliminarCategoria",function (e) {
  
        e.preventDefault();
  
        var deleteIdCategoria = $(this).attr("idCategoria");
  
        var datos = new FormData();
        datos.append("deleteIdCategoria", deleteIdCategoria);
  
        Swal.fire({
          title: "¿Está seguro de borrar la categoría?",
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
              url: "ajax/Categoria.ajax.php",
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
                    text: "La categoria ha sido eliminado",
                    icon: "success",
                  });
      
                  mostrarCategorias();
  
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
    mostrarCategorias();

  });



  