$(document).ready(function () {




  $("#button_submit_login").click(function () {
    let ingUsuario = $("#ingUsuario").val();
    let ingPassword = $("#ingPassword").val();

    $("#errorIngUsuario").empty();
    $("#errorIngPassword").empty();

    let valido = true;

    if (ingUsuario === "") {
      $("#errorIngUsuario")
        .text("Por favor, ingrese su correo o usuario")
        .css("color", "red");
      valido = false;
    }
    if (ingPassword === "") {
      $("#errorIngPassword")
        .text("Por favor, ingrese su contraseña")
        .css("color", "red");
      valido = false;
    }
  });
});
