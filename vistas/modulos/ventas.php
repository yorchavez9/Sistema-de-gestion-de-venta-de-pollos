<style>
    .flex-container {
        display: flex;
        flex-direction: column;
    }

    .flex-container ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .flex-container li {
        display: flex;
        justify-content: space-between;
    }

    .price {
        font-weight: bold;
    }

    .total-value {
        font-size: 1.5rem;
        color: #7367F0;
    }

    .hover_img {
        width: 100px;
        /* Tamaño original de la imagen */
        height: auto;
        transition: all 0.3s ease;
        /* Transición suave */
    }

    /* Estilo de la imagen cuando se agranda */
    .hover_img:hover {
        transform: scale(1.2);
        /* Aumenta el tamaño en un 20% */
    }
</style>

<!-- SECCCION DE CREAR VENTA -->
<div class="page-wrapper" id="pos_venta">
    <div class="content">

        <div class="card">
            <div class="card-body">

                <div class="page-header">
                    <div class="">
                        <h4 class="h2" style="font-size: 25px">Crear venta <i class="fas fa-shopping-cart" style="color: #5645ED"></i></h4>
                    </div>
                    <div class="page-btn">
                        <a href="#" id="ver_ventas" class="btn btn-added"><i class="fas fa-eye me-2"></i>Ver ventas</a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-7">

                        <!--======================================
                        FORMULARIO DE COMPRA DE PRODUCTO
                        ======================================-->

                        <form id="form_venta_producto">

                            <!-- INGRESO DE ID DEL USUARIO -->
                            <input type="hidden" id="id_usuario_venta" value="<?php echo $_SESSION["id_usuario"] ?>">


                            <div class="row">

                                <!-- INGRESO DE CLIENTE -->
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="id_cliente" class="form-label">Selecione el cliente(<span class="text-danger">*</span>):</label>

                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $proveedores = ControladorCliente::ctrMostrarCliente($item, $valor);

                                        ?>
                                        <select name="" id="id_cliente_venta" class="form-select small-select">


                                            <?php

                                            foreach ($proveedores as $key => $proveedor) {

                                                if ($proveedor["tipo_persona"] == "cliente") {
                                                    if ($proveedor["id_persona"] == 1) {
                                            ?>
                                                        <option value="<?php echo $proveedor["id_persona"] ?>" selected><?php echo $proveedor["razon_social"] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $proveedor["id_persona"] ?>"><?php echo $proveedor["razon_social"] ?></option>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>

                                        <small id="error_cliente_venta"></small>

                                    </div>

                                </div>

                                <!-- BOTON PARA AGREGAR CLIENTE -->
                                <div class="col-md-1">

                                    <div class="form-group">

                                        <a href="#" class="btn btn-sm btn-adds mt-4" id="btn_add_cliente" data-bs-toggle="modal" data-bs-target="#modalNuevoCliente"><i class="fa fa-user-plus me-2"></i></a>

                                    </div>

                                </div>

                                <!-- INGRESO DE LA FECHA -->
                                <div class="col-md-5">

                                    <div class="form-group">

                                        <label for="fecha_egre" class="form-label">Selecione la fecha(<span class="text-danger">*</span>):</label>

                                        <input type="date" id="fecha_venta" class="form-control" name="fecha_venta" placeholder="Ingrese la fecha">

                                        <small id="error_fecha_venta"></small>

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <!-- INGRESO DE TIPO DE COMPROBANTE -->
                                <div class="col-md-4">

                                    <label for="comprobante_venta" class="form-label">Tipo de comprobante(<span class="text-danger">*</span>):</label>

                                    <select name="comprobante_venta" id="comprobante_venta" class="form-control">

                                        <option value="boleta">Boleta</option>
                                        <option value="factura">Factura</option>
                                        <option value="ticket" selected>Ticket</option>

                                    </select>

                                    <small id="error_comprobante_venta"></small>

                                </div>

                                <!-- INGRESO DE LA SERIE -->
                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="serie_venta" class="form-label">Serie:</label>

                                        <input type="text" id="serie_venta" name="serie_venta" placeholder="Ingrese la serie" readonly>

                                    </div>

                                </div>

                                <!-- INGRESO DE NÚMERO -->
                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="numero_venta" class="form-label">Número:</label>

                                        <input type="text" id="numero_venta" name="numero_venta" placeholder="Ingrese el número" readonly>

                                    </div>

                                </div>

                                <!-- INGRESO EL INPUESTO -->
                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label for="igv_venta" class="form-label">Impuesto (%):</label>

                                        <input type="text" id="igv_venta" name="igv_venta" value="0" min="0" placeholder="Ingrese el impuesto">

                                    </div>

                                </div>


                            </div>


                            <div class="row">

                                <!-- TABLA DE SELECIÓN DE PRODUCTOS -->
                                <div class="table-responsive">

                                    <table class="table" width="100%">

                                        <thead>
                                            <tr style="background: #28C76F;">
                                                <th scope="col" class="text-white">Opciones</th>
                                                <th scope="col" class="text-white">Imagen</th>
                                                <th scope="col" class="text-white">Producto</th>
                                                <th scope="col" class="text-white">Cantidad U.</th>
                                                <th scope="col" class="text-white">Cantidad KG.</th>
                                                <th scope="col" class="text-white">Precio venta.</th>
                                                <th scope="col" class="text-white">Sub total</th>
                                            </tr>
                                        </thead>

                                        <tbody id="detalle_venta_producto">

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                </div>

                                <div class="col-md-6">

                                    <div class="pt-3 pb-2">

                                        <!-- SECCIÓN DE PRECIO DE VENTA -->
                                        <div class="flex-container">

                                            <ul>

                                                <li>
                                                    <p>Subtotal</p>
                                                    <p class="price">S/ <span id="subtotal_venta">00.00</span></p>
                                                </li>

                                                <li>
                                                    <p>IGV (%)</p>
                                                    <p class="price">S/ <span id="igv_venta_show">00.00</span></p>
                                                </li>

                                                <li class="total-value">
                                                    <p class="fw-bold">Total</p>
                                                    <p class="price">S/ <span id="total_precio_venta">00.00</span></p>
                                                </li>

                                            </ul>

                                        </div>

                                        <!-- SECTION DE VENTA AL CONTADO O AL CRÉDITO -->
                                        <div class="row mb-3">

                                            <div class="col">

                                                <div class="form-check">

                                                    <input class="form-check-input tipo_pago_venta" type="radio" name="forma_pago_v" value="contado" checked>

                                                    <label class="form-check-label" for="contado">

                                                        Al contado

                                                    </label>

                                                </div>

                                            </div>

                                            <div class="col">

                                                <div class="form-check">

                                                    <input class="form-check-input tipo_pago_venta" type="radio" name="forma_pago_v" value="credito">

                                                    <label class="form-check-label" for="credito">

                                                        Al crédito

                                                    </label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- SECCION DE PAGO AL CONTADO -->
                                        <div id="venta_al_contado">

                                            <div class="setvaluecash">

                                                <ul style="list-style-type: none;">

                                                    <li>
                                                        <a href="javascript:void(0);" class="paymentmethod tipo_pago_e_y">

                                                            <img src="vistas/dist/assets/img/icons/cash.svg" alt="img" class="me-2">

                                                            <input class="form-check-input tipo_pago_venta" type="radio" name="pago_tipo_v" value="efectivo">

                                                            <label class="form-check-label" for="credito">
                                                                Efectivo
                                                            </label>

                                                        </a>

                                                    </li>

                                                    <li style="float: right;">

                                                        <a href="javascript:void(0);" class="paymentmethod tipo_pago_e_y">

                                                            <img src="vistas/dist/assets/img/icons/scan.svg" alt="img" class="me-2">

                                                            <input class="form-check-input tipo_pago_venta" type="radio" name="pago_tipo_v" value="yape">

                                                            <label class="form-check-label" for="credito">
                                                                Yape
                                                            </label>

                                                        </a>

                                                    </li>

                                                </ul>

                                            </div>

                                        </div>


                                        <!-- SECCION DE CREAR VENTA -->
                                        <div class="row mb-3">

                                            <button type="button" id="btn_crear_nueva_venta" class="btn btn-block" style="background:#7367F0; color:white">

                                                <h5><i class="fa fa-plus fa-lg text-white me-2"></i> Crear compra</h5>

                                            </button>

                                        </div>



                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                    <!-- TABLA DE LISTA DE PRODUCTOS -->

                    <div class="col-md-5">

                        <div class="table-responsive">

                            <table class="table table-striped table-bordered" style="width:100%" id="tabla_add_producto_venta">

                                <thead>
                                    <tr>
                                        <th class="text-center">Imagen</th>
                                        <th>Categoría</th>
                                        <th>Precio</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>

                                <tbody id="data_productos_detalle_venta">

                                </tbody>

                            </table>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>

<!-- SECCCION DE EDITAR VENTA -->
<div class="page-wrapper" id="edit_pos_venta" style="display: none">
    <div class="content">

        <div class="card">
            <div class="card-body">

                <div class="page-header">
                    <div class="">
                        <h4 class="h2" style="font-size: 25px">Editar venta <i class="fas fa-shopping-cart" style="color: #5645ED"></i></h4>
                    </div>
                    <div class="page-btn">
                        <a href="#" class="btn btn-added seccion_lista_venta"><i class="fas fa-eye me-2"></i>Ver ventas</a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-7">

                        <!--======================================
                        FORMULARIO DE COMPRA DE PRODUCTO
                        ======================================-->

                        <form id="form_venta_producto">

                            <!-- INGRESO DE ID DEL USUARIO -->
                            <input type="text" id="edit_id_usuario_venta" value="<?php echo $_SESSION["id_usuario"] ?>">

                            <!-- INGRESO DE ID VENTA -->
                            <input type="text" id="edit_id_venta" value="">


                            <div class="row">

                                <!-- INGRESO DE CLIENTE -->
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="id_cliente" class="form-label">Selecione el cliente(<span class="text-danger">*</span>):</label>

                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $proveedores = ControladorCliente::ctrMostrarCliente($item, $valor);

                                        ?>
                                        <select name="" id="edit_id_cliente_venta" class="form-select small-select">

                                            <option value="">Selecione el cliente</option>

                                            <?php

                                            foreach ($proveedores as $key => $proveedor) {

                                                if ($proveedor["tipo_persona"] == "cliente") {

                                            ?>
                                                    <option value="<?php echo $proveedor["id_persona"] ?>"><?php echo $proveedor["razon_social"] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                        <small id="error_cliente_venta"></small>

                                    </div>

                                </div>

                                <!-- BOTON PARA AGREGAR CLIENTE -->
                                <div class="col-md-1">

                                    <div class="form-group">

                                        <a href="#" class="btn btn-sm btn-adds mt-4" id="btn_add_cliente" data-bs-toggle="modal" data-bs-target="#modalNuevoCliente"><i class="fa fa-user-plus me-2"></i></a>

                                    </div>

                                </div>

                                <!-- INGRESO DE LA FECHA -->
                                <div class="col-md-5">

                                    <div class="form-group">

                                        <label for="fecha_egre" class="form-label">Selecione la fecha(<span class="text-danger">*</span>):</label>

                                        <input type="date" id="edit_fecha_venta" class="form-control" name="fecha_venta" placeholder="Ingrese la fecha">

                                        <small id="error_fecha_venta"></small>

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <!-- INGRESO DE TIPO DE COMPROBANTE -->
                                <div class="col-md-4">

                                    <label for="comprobante_venta" class="form-label">Tipo de comprobante(<span class="text-danger">*</span>):</label>

                                    <select name="edit_comprobante_venta" id="edit_comprobante_venta" class="form-control">

                                        <option value="boleta">Boleta</option>
                                        <option value="factura">Factura</option>
                                        <option value="ticket" selected>Ticket</option>

                                    </select>

                                    <small id="error_comprobante_venta"></small>

                                </div>

                                <!-- INGRESO DE LA SERIE -->
                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="serie_venta" class="form-label">Serie:</label>

                                        <input type="text" id="edit_serie_venta" name="serie_venta" placeholder="Ingrese la serie" readonly>

                                    </div>

                                </div>

                                <!-- INGRESO DE NÚMERO -->
                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="numero_venta" class="form-label">Número:</label>

                                        <input type="text" id="edit_numero_venta" name="numero_venta" placeholder="Ingrese el número" readonly>

                                    </div>

                                </div>

                                <!-- INGRESO EL INPUESTO -->
                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label for="igv_venta" class="form-label">Impuesto (%):</label>

                                        <input type="text" id="edit_igv_venta" name="igv_venta" value="0" min="0" placeholder="Ingrese el impuesto">

                                    </div>

                                </div>


                            </div>


                            <div class="row">

                                <!-- TABLA DE SELECIÓN DE PRODUCTOS -->
                                <div class="table-responsive">

                                    <table class="table" width="100%">

                                        <thead>
                                            <tr style="background: #28C76F;">
                                                <th scope="col" class="text-white">Opciones</th>
                                                <th scope="col" class="text-white">Imagen</th>
                                                <th scope="col" class="text-white">Producto</th>
                                                <th scope="col" class="text-white">Cantidad U.</th>
                                                <th scope="col" class="text-white">Cantidad KG.</th>
                                                <th scope="col" class="text-white">Precio venta.</th>
                                                <th scope="col" class="text-white">Sub total</th>
                                            </tr>
                                        </thead>

                                        <tbody id="edit_detalle_venta_producto">

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                </div>

                                <div class="col-md-6">

                                    <div class="pt-3 pb-2">

                                        <!-- SECCIÓN DE PRECIO DE VENTA -->
                                        <div class="flex-container">

                                            <ul>

                                                <li>
                                                    <p>Subtotal</p>
                                                    <p class="price">S/ <span id="edit_subtotal_venta">00.00</span></p>
                                                </li>

                                                <li>
                                                    <p>IGV (%)</p>
                                                    <p class="price">S/ <span id="edit_igv_venta_show">00.00</span></p>
                                                </li>

                                                <li class="total-value">
                                                    <p class="fw-bold">Total</p>
                                                    <p class="price">S/ <span id="edit_total_precio_venta">00.00</span></p>
                                                </li>

                                            </ul>

                                        </div>

                                        <!-- SECTION DE VENTA AL CONTADO O AL CRÉDITO -->
                                        <div class="row mb-3">

                                            <div class="col">

                                                <div class="form-check">

                                                    <input class="form-check-input tipo_pago_venta" type="radio" name="forma_pago_v" value="contado">

                                                    <label class="form-check-label" for="contado">

                                                        Al contado

                                                    </label>

                                                </div>

                                            </div>

                                            <div class="col">

                                                <div class="form-check">

                                                    <input class="form-check-input tipo_pago_venta" type="radio" name="forma_pago_v" value="credito">

                                                    <label class="form-check-label" for="credito">

                                                        Al crédito

                                                    </label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- SECCION DE PAGO AL CONTADO -->
                                        <div id="edit_venta_al_contado">

                                            <div class="setvaluecash">

                                                <ul style="list-style-type: none;">

                                                    <li>
                                                        <a href="javascript:void(0);" class="paymentmethod tipo_pago_e_y">

                                                            <img src="vistas/dist/assets/img/icons/cash.svg" alt="img" class="me-2">

                                                            <input class="form-check-input tipo_pago_venta" type="radio" name="pago_tipo_v" value="efectivo">

                                                            <label class="form-check-label" for="credito">
                                                                Efectivo
                                                            </label>

                                                        </a>

                                                    </li>

                                                    <li style="float: right;">

                                                        <a href="javascript:void(0);" class="paymentmethod tipo_pago_e_y">

                                                            <img src="vistas/dist/assets/img/icons/scan.svg" alt="img" class="me-2">

                                                            <input class="form-check-input tipo_pago_venta" type="radio" name="pago_tipo_v" value="yape">

                                                            <label class="form-check-label" for="credito">
                                                                Yape
                                                            </label>

                                                        </a>

                                                    </li>

                                                </ul>

                                            </div>

                                        </div>


                                        <!-- SECCION DE CREAR VENTA -->
                                        <div class="row mb-3">

                                            <button type="button" id="btn_actualizar__venta" class="btn btn-block" style="background:#7367F0; color:white">

                                                <h5><i class="fa fa-plus fa-lg text-white me-2"></i> Actualizar venta</h5>

                                            </button>

                                        </div>



                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                    <!-- TABLA DE LISTA DE PRODUCTOS -->

                    <div class="col-md-5">

                        <div class="table-responsive">

                            <table class="table table-striped table-bordered" style="width:100%" id="tabla_edit_add_producto_venta">

                                <thead>
                                    <tr>
                                        <th class="text-center">Imagen</th>
                                        <th>Categoría</th>
                                        <th>Precio</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>

                                <tbody id="data_edit_productos_detalle_venta">

                                </tbody>

                            </table>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>

<!-- SECCCION DE VER VENTA -->
<div class="page-wrapper" id="ver_pos_venta" style="display: none">
    <div class="content">

        <div class="card">
            <div class="card-body">

                <div class="page-header">
                    <div class="">
                        <h4 class="h2" style="font-size: 25px">Detalles de la venta <i class="fas fa-shopping-cart" style="color: #5645ED"></i></h4>
                    </div>
                    <div class="page-btn">
                        <a href="#" class="btn btn-added seccion_lista_venta"><i class="fas fa-eye me-2"></i>Lista de ventas</a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-7">

                        <!--======================================
                        FORMULARIO DE COMPRA DE PRODUCTO
                        ======================================-->

                        <form id="form_venta_producto">

                            <!-- INGRESO DE ID DEL USUARIO -->
                            <input type="hidden" id="ver_id_usuario_venta" value="<?php echo $_SESSION["id_usuario"] ?>">

                            <!-- INGRESO DE ID VENTA -->
                            <input type="hidden" id="ver_id_venta" value="">


                            <div class="row">

                                <!-- INGRESO DE CLIENTE -->
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="id_cliente" class="form-label">Selecione el cliente(<span class="text-danger">*</span>):</label>

                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $proveedores = ControladorCliente::ctrMostrarCliente($item, $valor);

                                        ?>
                                        <select name="" id="ver_id_cliente_venta" class="form-select small-select" disabled>

                                            <option value="">Selecione el cliente</option>

                                            <?php

                                            foreach ($proveedores as $key => $proveedor) {

                                                if ($proveedor["tipo_persona"] == "cliente") {

                                            ?>
                                                    <option value="<?php echo $proveedor["id_persona"] ?>"><?php echo $proveedor["razon_social"] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                        <small id="error_cliente_venta"></small>

                                    </div>

                                </div>

                                <!-- BOTON PARA AGREGAR CLIENTE -->
                                <div class="col-md-1">

                                    <div class="form-group">


                                    </div>

                                </div>

                                <!-- INGRESO DE LA FECHA -->
                                <div class="col-md-5">

                                    <div class="form-group">

                                        <label for="fecha_egre" class="form-label">Selecione la fecha(<span class="text-danger">*</span>):</label>

                                        <input type="date" id="ver_fecha_venta" class="form-control" name="fecha_venta" placeholder="Ingrese la fecha" disabled>

                                        <small id="error_fecha_venta"></small>

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <!-- INGRESO DE TIPO DE COMPROBANTE -->
                                <div class="col-md-4">

                                    <label for="comprobante_venta" class="form-label">Tipo de comprobante(<span class="text-danger">*</span>):</label>

                                    <select name="ver_comprobante_venta" id="edit_comprobante_venta" class="form-control" disabled>

                                        <option value="boleta">Boleta</option>
                                        <option value="factura">Factura</option>
                                        <option value="ticket" selected>Ticket</option>

                                    </select>

                                    <small id="error_comprobante_venta"></small>

                                </div>

                                <!-- INGRESO DE LA SERIE -->
                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="serie_venta" class="form-label">Serie:</label>

                                        <input type="text" id="ver_serie_venta" name="serie_venta" placeholder="Ingrese la serie" readonly>

                                    </div>

                                </div>

                                <!-- INGRESO DE NÚMERO -->
                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label for="numero_venta" class="form-label">Número:</label>

                                        <input type="text" id="ver_numero_venta" name="numero_venta" placeholder="Ingrese el número" readonly>

                                    </div>

                                </div>

                                <!-- INGRESO EL INPUESTO -->
                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label for="igv_venta" class="form-label">Impuesto (%):</label>

                                        <input type="text" id="ver_igv_venta" name="igv_venta" value="0" min="0" placeholder="Ingrese el impuesto" disabled>

                                    </div>

                                </div>


                            </div>


                            <div class="row">

                                <!-- TABLA DE SELECIÓN DE PRODUCTOS -->
                                <div class="table-responsive">

                                    <table class="table" width="100%">

                                        <thead>
                                            <tr style="background: #28C76F;">
                                                <th scope="col" class="text-white">Imagen</th>
                                                <th scope="col" class="text-white">Producto</th>
                                                <th scope="col" class="text-white">Cantidad U.</th>
                                                <th scope="col" class="text-white">Cantidad KG.</th>
                                                <th scope="col" class="text-white">Precio venta.</th>
                                                <th scope="col" class="text-white">Sub total</th>
                                            </tr>
                                        </thead>

                                        <tbody id="ver_detalle_venta_producto">

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                </div>

                                <div class="col-md-6">

                                    <div class="pt-3 pb-2">

                                        <!-- SECCIÓN DE PRECIO DE VENTA -->
                                        <div class="flex-container">

                                            <ul>

                                                <li>
                                                    <p>Subtotal</p>
                                                    <p class="price">S/ <span id="ver_subtotal_venta">00.00</span></p>
                                                </li>

                                                <li>
                                                    <p>IGV (%)</p>
                                                    <p class="price">S/ <span id="ver_igv_venta_show">00.00</span></p>
                                                </li>

                                                <li class="total-value">
                                                    <p class="fw-bold">Total</p>
                                                    <p class="price">S/ <span id="ver_total_precio_venta">00.00</span></p>
                                                </li>

                                            </ul>

                                        </div>

                                        <!-- SECTION DE VENTA AL CONTADO O AL CRÉDITO -->
                                        <div class="row mb-3">

                                            <div class="col">

                                                <div class="form-check">

                                                    <input class="form-check-input tipo_pago_venta" type="radio" name="forma_pago_v" value="contado" disabled>

                                                    <label class="form-check-label" for="contado">

                                                        Al contado

                                                    </label>

                                                </div>

                                            </div>

                                            <div class="col">

                                                <div class="form-check">

                                                    <input class="form-check-input tipo_pago_venta" type="radio" name="forma_pago_v" value="credito" disabled>

                                                    <label class="form-check-label" for="credito">

                                                        Al crédito

                                                    </label>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- SECCION DE PAGO AL CONTADO -->
                                        <div id="ver_venta_al_contado">

                                            <div class="setvaluecash">

                                                <ul style="list-style-type: none;">

                                                    <li>
                                                        <a href="javascript:void(0);" class="paymentmethod tipo_pago_e_y">

                                                            <img src="vistas/dist/assets/img/icons/cash.svg" alt="img" class="me-2">

                                                            <input class="form-check-input tipo_pago_venta" type="radio" name="pago_tipo_v" value="efectivo">

                                                            <label class="form-check-label" for="credito">
                                                                Efectivo
                                                            </label>

                                                        </a>

                                                    </li>

                                                    <li style="float: right;">

                                                        <a href="javascript:void(0);" class="paymentmethod tipo_pago_e_y">

                                                            <img src="vistas/dist/assets/img/icons/scan.svg" alt="img" class="me-2">

                                                            <input class="form-check-input tipo_pago_venta" type="radio" name="pago_tipo_v" value="yape">

                                                            <label class="form-check-label" for="credito">
                                                                Yape
                                                            </label>

                                                        </a>

                                                    </li>

                                                </ul>

                                            </div>

                                        </div>


                                        <!-- SECCION DE CREAR VENTA -->
                                        <div class="row mb-3">

                                        
                                            <a href="#" class="btn btn-block seccion_lista_venta" style="background:#7367F0; color:white">
                                                <h5><i class="fas fa-arrow-left me-2"></i> Volver a la lista de ventas</h5>
                                            </a>

                                        </div>



                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                    <!-- TABLA DE LISTA DE PRODUCTOS -->

                    <div class="col-md-5">

                        <div class="table-responsive">

                            <table class="table table-striped table-bordered" style="width:100%" id="tabla_ver_add_producto_venta">

                                <thead>
                                    <tr>
                                        <th class="text-center">Imagen</th>
                                        <th>Categoría</th>
                                        <th>Precio</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>

                                <tbody id="data_ver_productos_detalle_venta">

                                </tbody>

                            </table>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>

<!-- SECCION MOSTRAR VENTAS -->
<div class="page-wrapper" id="ventas_lista" style="display: none">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de ventas</h4>
                <h6>Administrar ventas</h6>
            </div>
            <div class="page-btn">
                <a href="#" id="crear_venta" class="btn btn-added"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Crear venta</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
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
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="vistas/dist/assets/img/icons/pdf.svg" alt="img"></a>
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

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_lista_ventas">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Serie</th>
                                <th>Número</th>
                                <th>Tipo pago</th>
                                <th>Total compra</th>
                                <th>Total restante</th>
                                <th class="text-center">Estado pago</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_lista_ventas">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- MODAL NUEVO CLIENTE -->
<div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-labelledby="modalNuevoClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo cliente</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_cliente">

                <div class="modal-body">

                    <!-- INGRESO TIPO DE PERSONA -->
                    <div class="form-group">
                        <input type="hidden" id="tipo_personas_c" value="cliente">
                    </div>

                    <!-- INGRESO NOMBRE -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el nombre (<span class="text-danger">*</span>)</label>
                        <input type="text" id="razon_social_c" placeholder="Ingrese el nombre completo">
                        <small id="error_razon_social_c"></small>
                    </div>


                    <div class="row">

                        <!-- INGRESO DE TIPO DE DOCUMENTOS -->
                        <div class="col-md-6">
                            <label class="form-label">Selecione el tipo de documento (<span class="text-danger">*</span>)</label>
                            <?php
                            $item = null;
                            $valor = null;
                            $tiposDocumentos = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);
                            ?>
                            <select class="select" id="id_doc_c">
                                <option disabled selected>Seleccione</option>
                                <?php
                                foreach ($tiposDocumentos as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id_doc"] ?>"><?php echo $value["nombre_doc"] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <small id="error_id_doc_c"></small>
                        </div>

                        <!-- INGRESO DE NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="numero_documento_c" placeholder="Ingrese el número de documento">
                                <small id="error_numero_documento_c"></small>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <!-- INGRESE LA DIRECCIÓN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese la dirección </label>
                                <input type="text" id="direccion_c" placeholder="Ingrese la dirección">
                            </div>
                        </div>

                        <!-- INGRESE LA CIUDAD -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese la ciudad (<span class="text-danger">*</span>)</label>
                                <input type="text" id="ciudad_c" placeholder="Ingrese la ciudad">
                                <small id="error_ciudad_c"></small>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <!-- INGRESO DE CODIGO POSTAL -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo_postal" class="form-label">Ingrese el codigo postal</label>
                                <input type="text" id="codigo_postal_c" placeholder="Ingrese el código postal">
                                <small id="error_codigo_postal_c"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese el telefono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="telefono_c" placeholder="Ingrese el teléfono">
                                <small id="error_telefono_c"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DEL CORREO ELECTRÓNICO -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Ingrese el correo electrónico (<span class="text-danger">*</span>)</label>
                        <div class="pass-group">
                            <input type="text" id="correo_c" placeholder="Ingrese el correo electrónico">
                            <small id="error_correo_c"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sitio_web" class="form-label">Ingrese el sitio web</label>
                        <input type="text" id="sitio_web_c" placeholder="Ingrese el link del sitio web">
                        <small id="error_sitio_web_c"></small>
                    </div>

                    <div class="row">

                        <!-- INGRESO TIPO DE BANCO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_banco" class="form-label">Selecione el tipo de banco</label>
                                <select class="select" id="tipo_banco_c">
                                    <option disabled selected>Selecione</option>
                                    <option value="BCRP">Banco Central de Reserva del Perú</option>
                                    <option value="BCP">Banco de Crédito del Perú (BCP)</option>
                                    <option value="SBP">Scotiabank Perú</option>
                                    <option value="IB">Interbank</option>
                                    <option value="BBVA">BBVA Perú</option>
                                    <option value="BR">Banco Rural</option>
                                    <option value="BN">Banco de la Nación</option>
                                    <option value="BF">Banco Falabella</option>
                                </select>
                                <small id="error_tipo_banco_c"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_cuenta" class="form-label">Ingrese la cuenta bancaria</label>
                                <input type="text" id="numero_cuenta_c" placeholder="Ingrese el numero de cuenta bancaria">
                                <small id="error_numero_cuenta_c"></small>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_guardar_cliente" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL PAGAR COMPRA -->
<div class="modal fade" id="modalPagarVenta" tabindex="-1" aria-labelledby="modalPagarVentaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pagar deuda</h5>
                <button type="button" class="close btn_modal_ver_close_usuario" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="frm_pagar_deuda_venta">
                <div class="modal-body">

                    <input type="hidden" id="id_venta_pagar" name="id_venta_pagar">

                    <div class="row">
                        <div class="col-md-6 text-center">
                            <!-- COMPRA TOTAL -->
                            <div class="form-group">
                                <label><i class="fas fa-money-bill" style="color: #28C76F"></i> Compra total:</label>
                                <h3 class="fw-bold" id="total_venta_pagar"></h3>
                            </div>

                        </div>
                        <div class="col-md-6 text-center">
                            <div class="form-group">
                                <label><i class="fas fa-money-bill" style="color: #FF4D4D"></i> Total restante:</label>
                                <h3 class="fw-bold" style="color: #FF4D4D" id="pago_restante_pagar"></h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- FECHA DE PAGO -->
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <label class="form-label"><i class="fas fa-barcode text-danger"></i> Monto a pagar:</label>
                            <input type="text" id="monto_pagar_venta" name="monto_pagar_venta" class="form-control" placeholder="Ingrese el monto a pagar">
                            <small id="error_monto_pagar_venta"></small>
                        </div>
                        <div class="col-md-3"></div>
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" class="btn btn-primary" id="btn_pagar_deuda_venta"><i class="fa fa-save"></i> Pagar</button>
                    <button type="button" class="btn btn-secondary btn_modal_ver_close_usuario" data-bs-dismiss="modal"> Cerrar</button>
                </div>
            </form>


        </div>
    </div>
</div>


<script>
    function manejarAtajosTeclado(event) {
        if (event.ctrlKey) {
            switch (event.key) {
                case 'b':
                    $("#modalNuevoProveedor").modal("show");
                    break;
                case 'i':
                    $("#modalMostrarProductos").modal("show");
                    break;
                case 'm':
                    alert("Creando venta");
                    break;
            }
        }
    }

    function manejarClickBotonesVentas() {
        $("#ver_ventas").click(function() {
            $("#pos_venta").hide();
            $("#ventas_lista").show();
        });

        $("#crear_venta").click(function() {
            $("#ventas_lista").hide();
            $("#pos_venta").show();
        });
    }

    document.addEventListener('keydown', manejarAtajosTeclado);

    $(document).ready(manejarClickBotonesVentas);
</script>
