<div class="header">

    <div class="header-left active">
        <a href="index.html" class="logo">
            <img src="vistas/dist/assets/img/logo.png" alt="">
        </a>
        <a href="index.html" class="logo-small">
            <img src="vistas/dist/assets/img/logo-small.png" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">

        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Search Here ...">
                        <div class="search-addon">
                            <span><img src="vistas/dist/assets/img/icons/closes.svg" alt="img"></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="vistas/dist/assets/img/icons/search.svg" alt="img"></a>
                </form>
            </div>
        </li>


        <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
                <img src="vistas/dist/assets/img/flags/us1.png" alt="" height="20">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="vistas/dist/assets/img/flags/us.png" alt="" height="16"> Ingles
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="vistas/dist/assets/img/flags/fr.png" alt="" height="16"> Frances
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="vistas/dist/assets/img/flags/es.png" alt="" height="16"> Español
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="vistas/dist/assets/img/flags/de.png" alt="" height="16"> Aleman
                </a>
            </div>
        </li>


        <li class="nav-item dropdown">
            <?php
            
            $item = null;
            $valor = null;

            $productosPorVencer = ControladorProducto::ctrMostrarProductosFechaVencimientos($item, $valor);

            $totalProductosVencer = count($productosPorVencer);
            ?>
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <img src="vistas/dist/assets/img/icons/notification-bing.svg" alt="img"> <span class="badge rounded-pill" id="cantidad_notificacion"><?php echo $totalProductosVencer?></span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notificaciones</span>
                    <a href="javascript:void(0)" class="clear-noti" id="clear-noti">Limpiar todo</a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list" id="notification-list">

                        <?php

                        foreach ($productosPorVencer as $producto){
                        ?>

                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="<?php echo substr($producto["imagen_producto"],3)?>">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title"><?php echo $producto["nombre_producto"]?></span> <?php echo $producto["nombre_categoria"]?>
                        
                                        </p>
                                        <p class="noti-time"><span class="notification-time"><?php echo $producto["fecha_vencimiento"]?></span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <?php
                        }
                        ?>
                        

                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="productos">Ver todas las notificaciones</a>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="vistas/dist/assets/img/profiles/avator1.jpg" alt="">
                    <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="vistas/dist/assets/img/profiles/avator1.jpg" alt="">
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6><?php echo $_SESSION["usuario"]?></h6>
                            <h5>
                            <?php

                                $data_roles = json_decode($_SESSION["roles"], true);
                                foreach ($data_roles as $rol) {
                                    echo $rol . "<br>";
                                }

                            ?>
                            </h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="usuarios"> <i class="me-2" data-feather="user"></i>Mi perfil</a>
                    <a class="dropdown-item" href="usuarios"><i class="me-2" data-feather="settings"></i>Configuración</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="salir"><img src="vistas/dist/assets/img/icons/log-out.svg" class="me-2" alt="img">Salir</a>
                </div>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="usuarios">Mi perfil</a>
            <a class="dropdown-item" href="usuarios">Configuración</a>
            <a class="dropdown-item" href="salir">Salir</a>
        </div>
    </div>

</div>

<script>
document.getElementById('clear-noti').addEventListener('click', function() {
    document.getElementById('notification-list').innerHTML = '';
    document.getElementById('cantidad_notificacion').innerHTML = '0';
});
</script>
