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
</style>


<div class="page-wrapper">
    <div class="content">

        <div class="card">
            <div class="card-body">

                <div class="table-top">

                    <div class="wordset">
                        <h3 class="fw-bold">Crear venta <i class="fas fa-shopping-cart" style="color: #5645ED"></i></h3>
                    </div>
                </div>


                <!--======================================
                FORMULARIO DE COMPRA DE PRODUCTO
                ======================================-->
                <form id="form_compra_producto">

                    <!-- INGRESO DE ID DEL USUARIO -->
                    <input type="hidden" id="id_usuario_egreso" value="<?php echo $_SESSION["id_usuario"] ?>">


                    <div class="row">


                        <!-- INGRESO DE CLIENTE -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="id_cliente" class="form-label">Selecione el proveedor(<span class="text-danger">*</span>):</label>
                                <?php
                                $item = null;
                                $valor = null;

                                $proveedores = ControladorProveedores::ctrMostrarProveedor($item, $valor);
                                ?>
                                <select name="" id="id_proveedor_egreso" class="form-select">
                                    <option value="">Selecione el proveedor</option>
                                    <?php
                                    foreach ($proveedores as $key => $proveedor) {
                                        if ($proveedor["tipo_persona"] == "proveedor") {
                                    ?>
                                            <option value="<?php echo $proveedor["id_persona"] ?>"><?php echo $proveedor["razon_social"] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <small id="error_egreso_proveedor"></small>
                            </div>
                        </div>

                        <!-- BOTON PARA AGREGAR CLIENTE -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <a href="#" class="btn btn-sm btn-adds mt-4" id="btn_add_cliente" data-bs-toggle="modal" data-bs-target="#modalNuevoProveedor"><i class="fa fa-user-plus me-2"></i>Agregar</a>
                            </div>
                        </div>

                        <!-- INGRESO DE LA FECHA -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="fecha_egre" class="form-label">Selecione la fecha(<span class="text-danger">*</span>):</label>
                                <input type="date" id="fecha_egreso" class="form-control" name="fecha_egre" placeholder="Ingrese la fecha">
                                <small id="error_egreso_fecha"></small>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <!-- INGRESO DE TIPO DE COMPROBANTE -->
                        <div class="col-md-5">
                            <label for="tipo_comprobante" class="form-label">Tipo de comprobante(<span class="text-danger">*</span>):</label>
                            <select name="tipo_comprobante" id="tipo_comprobante_egreso" class="form-control">
                                <option value="" selected disabled>Selecione el comprobante</option>
                                <option value="boleta">Boleta</option>
                                <option value="factura">Factura</option>
                                <option value="ticket">Ticket</option>
                            </select>
                            <small id="error_compra_comprobante"></small>
                        </div>

                        <!-- INGRESO DE LA SERIE -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="serie_comprobante" class="form-label">Serie:</label>
                                <input type="text" id="serie_comprobante" name="serie_comprobante" placeholder="Ingrese la serie">
                            </div>
                        </div>

                        <!-- INGRESO DE NÚMERO -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="num_comprobante" class="form-label">Número:</label>
                                <input type="text" id="num_comprobante" name="num_comprobante" placeholder="Ingrese el número">
                            </div>
                        </div>

                        <!-- INGRESO EL INPUESTO -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="impuesto" class="form-label">Impuesto (%):</label>
                                <input type="text" id="impuesto_egreso" name="impuesto" value="0" min="0" placeholder="Ingrese el impuesto">
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <a href="javascript:void(0);" class="btn btn-adds" data-bs-toggle="modal" data-bs-target="#modalMostrarProductos"><i class="fa fa-plus me-2"></i>Agregar producto</a>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>

                    <div class="row">
                        <table class="table table-responsive" width="100%">
                            <thead>
                                <tr style="background: #28C76F;">
                                    <th scope="col" class="text-white">Opciones</th>
                                    <th scope="col" class="text-white">Imagen</th>
                                    <th scope="col" class="text-white">Producto</th>
                                    <th scope="col" class="text-white">Cantidad U.</th>
                                    <th scope="col" class="text-white">Cantidad KG.</th>
                                    <th scope="col" class="text-white">Precio compra</th>
                                    <th scope="col" class="text-white">Precio venta.</th>
                                    <th scope="col" class="text-white">Sub total</th>
                                </tr>
                            </thead>
                            <tbody id="detalle_egreso_producto">

                            </tbody>
                        </table>

                    </div>

                    <div class="row">
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-5">
                            <div class="pt-3 pb-2">

                                <div class="flex-container">
                                    <ul>
                                        <li>
                                            <p>Subtotal</p>
                                            <p class="price">S/ <span id="subtotal_egreso">00.00</span></p>
                                        </li>
                                        <li>
                                            <p>IGV (%)</p>
                                            <p class="price">S/ <span id="igv_egreso">00.00</span></p>
                                        </li>
                                        <li class="total-value">
                                            <p class="fw-bold">Total</p>
                                            <p class="price">S/ <span id="total_precio_egreso">00.00</span></p>
                                        </li>
                                    </ul>
                                </div>

                                <!-- SECTION DE VENTA AL CONTADO O AL CRÉDITO -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input tipo_pago_egreso" type="radio" name="forma_pago" value="contado" checked>
                                            <label class="form-check-label" for="contado">
                                                Al contado
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input tipo_pago_egreso" type="radio" name="forma_pago" value="credito">
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
                                                <a href="javascript:void(0);" class="paymentmethod">
                                                    <img src="vistas/dist/assets/img/icons/cash.svg" alt="img" class="me-2">
                                                    <input class="form-check-input tipo_pago_egreso" type="radio" name="pago_tipo" value="efectivo">
                                                    <label class="form-check-label" for="credito">
                                                        Efectivo
                                                    </label>
                                                </a>
                                            </li>
                                            <li style="float: right;">
                                                <a href="javascript:void(0);" class="paymentmethod">
                                                    <img src="vistas/dist/assets/img/icons/scan.svg" alt="img" class="me-2">
                                                    <input class="form-check-input tipo_pago_egreso" type="radio" name="pago_tipo" value="yape">
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
                                    <button type="button" id="btn_crear_venta" class="btn btn-block" style="background:#7367F0; color:white">
                                        <h5><i class="fa fa-plus fa-lg text-white me-2"></i> Crear compra</h5>
                                    </button>
                                </div>



                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>


<!-- MODAL MOSTRAR PRODUCTOS -->
<div class="modal fade" id="modalMostrarProductos" tabindex="-1" aria-labelledby="modalNuevoProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecione el producto </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="card">
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="tabla_add_producto">
                            <thead>
                                <tr>
                                    <th class="text-center">N°</th>
                                    <th>Código</th>
                                    <th>Imagen</th>
                                    <th>Categoría</th>
                                    <th>Nombre</th>
                                    <th>Stock</th>
                                    <th>Fecha v.</th>
                                </tr>
                            </thead>
                            <tbody id="data_productos_detalle">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL EDITAR PRODUCTO -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar producto</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_editar_producto">
                <div class="modal-body">

                    <!-- ID PRODUCTO -->
                    <input type="hidden" id="edit_id_producto">

                    <div class="row">

                        <!-- INGRESOO DE LA CATEGORIA -->
                        <div class="col-md-6">
                            <label class="form-label">Selecione la categoría (<span class="text-danger">*</span>)</label>
                            <?php
                            $item = null;
                            $valor = null;
                            $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                            ?>
                            <select class="form-select form-select-sm" id="edit_id_categoria_p">
                                <option disabled selected>Seleccione</option>
                                <?php
                                foreach ($categorias as $key => $categoria) {
                                ?>
                                    <option value="<?php echo $categoria["id_categoria"] ?>"><?php echo $categoria["nombre_categoria"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <small id="edit_error_id_categoria_p"></small>
                        </div>

                        <!-- INGRESO DE DEL CODIGO  -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo" class="form-label">Ingrese el código del producto (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_codigo_producto" placeholder="Ingrese el código del producto">
                                <small id="edit_error_codigo_p"></small>
                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- INGRESO DE NOMBRE  -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese el nombre del producto (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_nombre_producto" placeholder="Ingrese el nombre del producto">
                                <small id="edit_error_nombre_p"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE STOCK -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock" class="form-label">Ingrese el stock (<span class="text-danger">*</span>)</label>
                                <input type="number" id="edit_stock_producto" value="0" class="form-control form-control">
                                <small id="edit_error_stock_p"></small>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion_producto" class="form-label"> Ingrese la descripción</label>
                        <textarea name="edit_descripcion_producto" id="edit_descripcion_producto" cols="30" rows="10" placeholder="Ingrese la descripción del producto"></textarea>
                    </div>

                    <!-- INGRESO DE LA IMAGEN -->
                    <div class="form-group">
                        <label for="imagen_producto" class="form-label">Selecione la imagen</label>
                        <input type="file" class="form-control" id="edit_imagen_producto">
                        <input type="hidden" id="edit_imagen_actual_p">
                        <div class="text-center mt-3">
                            <img src="" class="edit_vista_previa_imagen_p img img-fluid" width="250" alt="">
                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_actualizar_producto" class="btn btn-primary mx-2"><i class="fas fa-sync"></i> Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- MODAL VER PRODUCTO -->
<div class="modal fade" id="modalVerProducto" tabindex="-1" aria-labelledby="modalVerProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del producto</h5>
                <button type="button" class="close btn_modal_ver_close_usuario" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="formVerUsuario">
                <div class="modal-body">

                    <!-- MOSTRANDO NOMBRE DE LA CATEGORIA -->
                    <div class="form-group">
                        <label><i class="fas fa-user text-primary"></i> Categoría del producto:</label>
                        <p id="mostrar_nombre_categoria"></p>
                    </div>

                    <div class="row">

                        <!-- MOSTRANDO CODIGO DEL PRODUCTO -->
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-barcode text-danger"></i> Código del producto:</label>
                            <p id="mostrar_codigo_producto"></p>
                        </div>

                        <!-- MOSTRANDO NOMBRE DEL PRODUCTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_producto" class="form-label"><i class="fas fa-tag text-success"></i> Nombre del producto:</label>
                                <p id="mostrar_nombre_producto"></p>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <!-- MOSTRAR EL STOCK DEL PRODUCTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock_producto" class="form-label"><i class="fas fa-box text-warning"></i> Stock del producto:</label>
                                <p id="mostrar_stock_producto"></p>
                            </div>
                        </div>

                        <!-- MOSTRAR LA DESCRIPCION DEL PRODUCTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion" class="form-label"><i class="fas fa-info-circle text-info"></i> Descripción del producto:</label>
                                <p id="mostrar_descripcion_producto"></p>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <!-- MOSTRANDO EL ESTADO DEL PRODUCTO -->
                        <div class="form-group col-md-6">
                            <label class="form-label"><i class="fas fa-check-circle text-warning"></i> Estado del producto:</label>
                            <div id="mostrar_estado_producto" class="mx-2">

                            </div>
                        </div>

                        <!-- MOSTRANDO LA FECHA DEL PRODUCTO -->
                        <div class="form-group col-md-6">
                            <label class="form-label"><i class="fas fa-calendar-alt text-warning"></i> Fecha de registro del producto:</label>
                            <p id="mostrar_fecha_producto"></p>
                        </div>
                    </div>

                    <!-- MOSTRAR IMAGEN DEL PRODUCTO -->
                    <div class="form-group text-center">
                        <label for="imagen_usuario" class="form-label"><i class="fas fa-image text-success"></i> Imagen del producto:</label>
                        <div class="text-center mt-3">
                            <img src="" class="mostrarImagenProducto img img-fluid" width="250" alt="">
                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" class="btn btn-secondary btn_modal_ver_close_usuario" data-bs-dismiss="modal"> Cerrar</button>
                </div>
            </form>


        </div>
    </div>
</div>


<!-- MODAL NUEVO PROVEEDORES -->
<div class="modal fade" id="modalNuevoProveedor" tabindex="-1" aria-labelledby="modalNuevoProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo proveedor</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>


            <form enctype="multipart/form-data" id="nuevoProveedor">


                <div class="modal-body">

                    <!-- INGRESO TIPO DE PROVEEDOR -->
                    <div class="form-group">
                        <input type="hidden" id="tipo_persona_proveedor" value="proveedor">
                    </div>

                    <!-- INGRESO DE RAZÓN SOCIAL -->
                    <div class="form-group">
                        <label class="form-label">Ingrese la razón social (<span class="text-danger">*</span>)</label>
                        <input type="text" id="razon_social_proveedor" placeholder="Ingrese la razon social">
                        <small id="validate_razon_social_proveedor"></small>
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
                            <select class="select" id="id_doc_proveedor">
                                <option disabled selected>Seleccione</option>
                                <?php
                                foreach ($tiposDocumentos as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id_doc"] ?>"><?php echo $value["nombre_doc"] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <small id="validate_tipo_documento_proveedor"></small>
                        </div>

                        <!-- INGRESO DE NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="numero_documento_proveedor" placeholder="Ingrese el número de documento">
                                <small id="validate_numero_documento_proveedor"></small>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <!-- INGRESE LA DIRECCIÓN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese la dirección </label>
                                <input type="text" id="direccion_proveedor" placeholder="Ingrese la dirección">
                            </div>
                        </div>

                        <!-- INGRESE LA CIUDAD -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese la ciudad (<span class="text-danger">*</span>)</label>
                                <input type="text" id="ciudad_proveedor" placeholder="Ingrese la ciudad">
                                <small id="validate_ciudad_proveedor"></small>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <!-- INGRESO DE CODIGO POSTAL -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo_postal" class="form-label">Ingrese el codigo postal</label>
                                <input type="text" id="codigo_postal_proveedor" placeholder="Ingrese el código postal">
                                <small id="validate_codigo_postal_proveedor"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese el telefono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="telefono_proveedor" placeholder="Ingrese el teléfono">
                                <small id="validate_telefono_proveedor"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DEL CORREO ELECTRÓNICO -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Ingrese el correo electrónico (<span class="text-danger">*</span>)</label>
                        <div class="pass-group">
                            <input type="text" id="correo_proveedor" placeholder="Ingrese el correo electrónico">
                            <small id="validate_correo_proveedor"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sitio_web" class="form-label">Ingrese el sitio web</label>
                        <input type="text" id="sitio_web_proveedor" placeholder="Ingrese el link del sitio web">
                        <small id="validate_sitio_web_proveedor"></small>
                    </div>

                    <div class="row">

                        <!-- INGRESO TIPO DE BANCO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_banco" class="form-label">Selecione el tipo de banco</label>
                                <select class="select" id="tipo_banco_proveedor">
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
                                <small id="tipo_banco_proveedor"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_cuenta" class="form-label">Ingrese la cuenta bancaria</label>
                                <input type="text" id="numero_cuenta_proveedor" placeholder="Ingrese el numero de cuenta bancaria">
                                <small id="validate_numero_bancaria_proveedor"></small>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="guardar_proveedor" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('keydown', function(event) {

        if (event.ctrlKey && event.key === 'b') {
            $("#modalNuevoProveedor").modal("show")

        } else if (event.ctrlKey && event.key === 'i') {
            $("#modalMostrarProductos").modal("show")
        } else if (event.ctrlKey && event.key === 'm') {
            alert("Creando venta")
        }

    });

    const today = new Date().toISOString().split('T')[0];

    // Asignar la fecha actual al campo de entrada de fecha
    document.getElementById('fecha_egreso').value = today;
</script>