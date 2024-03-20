<?php include "modulos/layouts/head.php";?>

<?php 

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
?>
    <?php echo '<div class="main-wrapper">';?>

        <?php include "modulos/header.php"?>

        <?php include "modulos/sidebar.php";?>

        <?php include "modulos/inicio.php"?>

    <?php echo '</div>';?>
<?php
}else{
 include "modulos/login.php"; 
}
?>

<?php include "modulos/layouts/footer.php";?>