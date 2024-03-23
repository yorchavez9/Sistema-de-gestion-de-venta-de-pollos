<?php

session_start();

include "modulos/layouts/head.php";

?>

<?php

if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
?>
    <?php echo '<div class="main-wrapper">'; ?>

        <?php include "modulos/header.php" ?>

        <?php include "modulos/sidebar.php"; ?>

        <?php
        if (isset($_GET["ruta"])) {

            if (
                $_GET["ruta"] == "inicio" ||
                $_GET["ruta"] == "tipoDocumento" ||
                $_GET["ruta"] == "usuarios" ||
                $_GET["ruta"] == "categorias" ||
                $_GET["ruta"] == "productos" ||
                $_GET["ruta"] == "clientes" ||
                $_GET["ruta"] == "ventas" ||
                $_GET["ruta"] == "crear-venta" ||
                $_GET["ruta"] == "editar-venta" ||
                $_GET["ruta"] == "reportes" ||
                $_GET["ruta"] == "salir"
            ) {

                include "modulos/" . $_GET["ruta"] . ".php";
            } else {

                include "modulos/404.php";
            }
        } else {

            include "modulos/inicio.php";
        }


        ?>


    <?php echo '</div>'; ?>
<?php
} else {
    include "modulos/login.php";

}
?>

<?php include "modulos/layouts/footer.php"; ?>