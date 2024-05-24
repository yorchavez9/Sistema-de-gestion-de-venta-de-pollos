<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Reporte de ventas</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">


                <form id="form_mostrar_venta_reporte" class="mb-4">

                    <div class="col-md-12">

                        <div class="row">

                            <!-- INGRESO DE FECHA DESDE -->

                            <div class="col-md-2">

                                <label for="fecha_inicio" class="form-label">Desde: </label>

                                <input type="date" id="fecha_desde_reporte_v" class="form-control" required>

                                <small id="error_fecha_desde_reporte_v"></small>

                            </div>

                            <!-- INGRESO DE FECHA HASTA -->

                            <div class="col-md-2">

                                <label for="fecha_fin" class="form-label">Hasta: </label>

                                <input type="date" id="fecha_hasta_reporte_v" class="form-control" required>

                                <small id="error_fecha_hasta_reporte_v"></small>

                            </div>

                            <!-- INGRESO DE USUARIO -->

                            <div class="col-md-2">

                                <label for="usuario" class="form-label">Usuario: </label>

                                <?php

                                $item = null;

                                $valor = null;

                                ?>

                                <select id="id_usuario_reporte_v" class="form-select">

                                    <option selected disabled>Seleccione</option>

                                    <?php

                                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                                    foreach ($usuarios as $usuario) {
                                    ?>

                                        <option value="<?php echo $usuario["id_usuario"] ?>"><?php echo $usuario["nombre_usuario"] ?></option>

                                    <?php
                                    }

                                    ?>

                                </select>

                            </div>

                            <!-- INGRESO DE TIPO DE VENTA -->

                            <div class="col-md-2">

                                <label for="" class="form-label">Tipo de venta</label>

                                <select id="tipo_pago_reporte_v" class="form-select">

                                    <option selected disabled>Seleccione</option>
                                    <option value="contado">Contado</option>
                                    <option value="credito">Crédito</option>

                                </select>

                            </div>

                            <!-- INGRESO DE PRECIO TOTAL DE VENTA -->

                            <div class="col-md-2 text-center">

                                <label for="" class="form-label">Precio producto:</label><br>

                                <input type="checkbox" class="form-check-input" id="descuento_producto_v" value="descuento">

                            </div>

                            <!-- INGRESO DE CLIENTE -->

                            <div class="col-md-2">

                                <label for="" class="form-label">Selecione el cliente</label><br>
                                <?php
                                
                                $item = null;
                                $valor = null;

                                $clientes = ControladorCliente::ctrMostrarCliente($item, $valor);
                                ?>
                                <select id="id_cliente_reporte" class="form-select">

                                    <option value="" selected disabled>Seleccione</option>

                                    <?php
                                    foreach ($clientes as $cliente) {
                                    ?>
                                    <option value="<?php echo $cliente["id_persona"]?>"><?php echo $cliente["razon_social"]?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                

                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <!-- BOTON VER REPORTE -->

                            <div class="text-center">

                                <label for="" class="form-label">.</label><br>

                                <button type="button" id="btn_ver_reporte_ventas" class="btn btn-primary"> Ver reporte <i class="fas fa-file-pdf"></i></button>

                            </div>

                        </div>
                    </div>
                </form>

                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="vistas/dist/assets/img/icons/filter.svg" alt="img">
                                <span><img src="vistas/dist/assets/img/icons/closes.svg" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset">
                                <img src="vistas/dist/assets/img/icons/search-white.svg" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" id="btn_descargar_reporte_ventas" data-bs-placement="top" title="pdf"><img src="vistas/dist/assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="vistas/dist/assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="vistas/dist/assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>


                <!-- REPORTE DE TODAS LAS VENTAS -->

                <div class="table-responsive" id="section_tabla_reporte_ventas" style="display: block">
                    <table class="table table-striped table-bordered" id="tabla_reporte_ventas" style="width:100%;">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Serie</th>
                                <th>Número</th>
                                <th>Tipo venta</th>
                                <th>Venta total</th>
                                <th>Restante</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="data_ventas_reporte">

                        </tbody>
                    </table>

                </div>


                <!-- REPORTE DE RANGO DE FECHA Y EL USUARIO -->

                <div class="table-responsive" id="section_tabla_reporte_ventas_fecha_venta" style="display: none">
                    <table class="table table-striped table-bordered" id="tabla_reporte_ventas_fecha" style="width:100%">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Serie</th>
                                <th>Número</th>
                                <th>Tipo venta</th>
                                <th>Venta total</th>
                                <th>Restante</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="data_ventas_reporte_fecha">

                        </tbody>
                    </table>

                </div>

                <!-- REPORTE DE RANGO DE FECHA, USUARIO y TIPO DE PAGO -->

                <div class="table-responsive" id="section_tabla_reporte_rango_fechas" style="display: none">
                    <table class="table table-striped table-bordered" id="tabla_reporte_rango_fecha_venta" style="width:100%">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Serie</th>
                                <th>Número</th>
                                <th>Tipo venta</th>
                                <th>Venta total</th>
                                <th>Restante</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="data_ventas_reporte_rango_fecha_venta">

                        </tbody>
                    </table>

                </div>


                <!-- REPORTE USUARIO Y PRODUCTOS MODIFICADOS DE PRECIOS -->

                <div class="table-responsive" id="section_tabla_reporte_ventas_precio_producto" style="display: none">
                    <table class="table table-striped table-bordered" id="tabla_reporte_ventas_precio_producto" style="width:100%">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Usuario</th>
                                <th>Producto</th>
                                <th>Precio venta</th>
                                <th>Precio modificado</th>
                                <th>Fecha venta</th>
                            </tr>
                        </thead>
                        <tbody id="data_ventas_reporte_precio_producto">

                        </tbody>
                    </table>

                </div>


                <!-- REPORTE CREDITO POR CLIENTE -->

                <div class="table-responsive" id="section_tabla_reporte_credito_cliente" style="display: none">

                    <table class="table table-striped table-bordered" id="tabla_reporte_credito_cliente" style="width:100%">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Serie</th>
                                <th>Número</th>
                                <th>Tipo venta</th>
                                <th>Venta total</th>
                                <th>Restante</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="data_ventas_reporte_credito_cliente">

                        </tbody>
                    </table>

                </div>


            </div>
        </div>

    </div>
</div>
