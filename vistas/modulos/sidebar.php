<?php

$data_roles = json_decode($_SESSION["roles"], true);

?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="inicio"><img src="vistas/dist/assets/img/icons/dashboard.svg" alt="img"><span>
                            Panel</span> </a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="vistas/dist/assets/img/icons/users1.svg" alt="img"><span>
                            Personas</span> <span class="menu-arrow"></span></a>
                    <ul>

                        <?php

                        foreach ($data_roles as $rol) {

                            if ($rol == "administrador") {
                        ?>
                                <li><a href="tipoDocumento">Tipo documento</a></li>
                                <li><a href="usuarios">Usuarios</a></li>
                        <?php
                            }
                        }

                        ?>

                        <li><a href="proveedores">Proveedores</a></li>
                        <li><a href="clientes">Clientes</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="vistas/dist/assets/img/icons/product.svg" alt="img"><span>
                            Inventario</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="categorias">Categorias</a></li>
                        <li><a href="proveedores">Proveedor</a></li>
                        <li><a href="productos">Producto</a></li>
                        <li><a href="codigoBarra">Imprimir código de barras</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="vistas/dist/assets/img/icons/sales1.svg" alt="img"><span>
                            Ventas</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="clientes">Clientes</a></li>
                        <li><a href="ventas">Punto de venta</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="vistas/dist/assets/img/icons/purchase1.svg" alt="img"><span>
                            Compras</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="proveedores">Proveedor</a></li>
                        <li><a href="compras">Compra</a></li>
                        <li><a href="listaCompras">Lista de compras</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="vistas/dist/assets/img/icons/users1.svg" alt="img">
                        <span>Trabajadores</span> <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="trabajador">Trabajadores</a></li>
                        <li><a href="contratoTrabajador">Contrato trabajador</a></li>
                        <li><a href="pagoTrabajador">Pagos trabajador</a></li>
                        <li><a href="vacaciones">Vacaciones</a></li>
                        <li><a href="asistencia">Asistencia</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="vistas/dist/assets/img/icons/time.svg" alt="img"><span>
                            Reportes</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="reporteUsuario">Reporte de usuarios</a></li>
                        <li><a href="reporteProveedor">Reporte de proveedores</a></li>
                        <li><a href="reporteCliente">Reporte de clientes</a></li>
                        <li><a href="reporteProducto">Reporte de productos</a></li>
                        <li><a href="reporteVenta">Reporte de venta</a></li>
                    </ul>
                </li>
                <?php

                foreach ($data_roles as $rol) {

                    if ($rol == "administrador") {
                ?>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="vistas/dist/assets/img/icons/settings.svg" alt="img"><span>
                                    Ajustes</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="configuracionTicket">Configuración Ticket</a></li>
                                <li><a href="configuracionImpresora">Configuración Impresora</a></li>
                            </ul>
                        </li>
                <?php
                    }
                }

                ?>

            </ul>
        </div>
    </div>
</div>
