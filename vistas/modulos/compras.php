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
                        <h3 class="fw-bold">Crear venta <i class="fas fa-shopping-cart" style="color: #FF9F43"></i></h3>
                    </div>
                </div>
                <div class="row">

                    <!-- INGRESO DE CLIENTE -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="id_cliente" class="form-label">Selecione el proveedor(<span class="text-danger">*</span>):</label>
                            <select name="" id="" class="form-control">
                                <option value="">Selecione el cliente</option>
                                <option value="">Juan</option>
                                <option value="">Luis</option>
                            </select>
                        </div>
                    </div>

                    <!-- BOTON PARA AGREGAR CLIENTE -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <a href="#" class="btn btn-sm btn-adds mt-4" data-bs-toggle="modal" data-bs-target="#modalNuevoClienteCompra"><i class="fa fa-user-plus me-2"></i>Agregar</a>
                        </div>
                    </div>

                    <!-- INGRESO DE LA FECHA -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="fecha_egre" class="form-label">Selecione la fecha(<span class="text-danger">*</span>):</label>
                            <input type="date" id="fecha_egre" class="form-control" name="fecha_egre" placeholder="Ingrese la fecha">
                        </div>
                    </div>

                </div>
                <div class="row">

                    <!-- INGRESO DE TIPO DE COMPROBANTE -->
                    <div class="col-md-5">
                        <label for="tipo_comprobante" class="form-label">Tipo de comprobante(<span class="text-danger">*</span>):</label>
                        <select name="tipo_comprobante" id="tipo_comprobante" class="form-control">
                            <option value="" selected disabled>Selecione el comprobante</option>
                            <option value="boleta">Boleta</option>
                            <option value="factura">Factura</option>
                            <option value="ticket">Ticket</option>
                        </select>
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
                            <input type="text" id="impuesto" name="impuesto" placeholder="Ingrese el impuesto">
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
                        <tbody>
                            <tr>
                                <th class="text-center align-middle d-none d-md-table-cell">
                                    <a href="#" class="me-3 confirm-text btnEliminarUsuario" idUsuario="${usuario.id_usuario}" fotoUsuario="${usuario.imagen_usuario}">
                                        <i class="fa fa-trash fa-lg" style="color: #F1666D"></i>
                                    </a>
                                </th>
                                <td>
                                    <img src="vistas/img/productos/202404020107335335.jpg" alt="Imagen de un pollo" width="80">
                                </td>
                                <td>Pollo 2B</td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="0">
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="0">
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="0">
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="0">
                                </td>
                                <td>
                                    <p class="price">S/ 123.30</p>
                                </td>
                            </tr>
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
                                        <p class="price">S/ 55.00</p>
                                    </li>
                                    <li>
                                        <p>IGV (%)</p>
                                        <p class="price">S/ 5.00</p>
                                    </li>
                                    <li class="total-value">
                                        <p class="fw-bold">Total</p>
                                        <p class="price">S/ 60.00</p>
                                    </li>
                                </ul>
                            </div>

                            <!-- SECTION DE VENTA AL CONTADO O AL CRÉDITO -->
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="forma_pago" id="contado" value="contado" checked>
                                        <label class="form-check-label" for="contado">
                                            Al contado
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="forma_pago" id="credito" value="credito">
                                        <label class="form-check-label" for="credito">
                                            Al crédito
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- SECCION DE PAGO AL CONTADO -->
                            <div id="venta_al_contado">
                                <div class="setvaluecash">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);" class="paymentmethod">
                                                <img src="vistas/dist/assets/img/icons/cash.svg" alt="img" class="me-2">
                                                Efectivo
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="paymentmethod">
                                                <img src="vistas/dist/assets/img/icons/debitcard.svg" alt="img" class="me-2">
                                                Targeta
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="paymentmethod">
                                                <img src="vistas/dist/assets/img/icons/scan.svg" alt="img" class="me-2">
                                                Yape
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- SECCION DE PAGO AL CRÉDITO -->
                            <div id="venta_al_credito">
                                <div class="row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="cantidad_meses" class="form-label">Cantidad de meses:</label>
                                        <input type="number" id="cantidad_meses" value="0" min="0" class="form-control">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="cantidad_meses" class="form-label">Fecha de pago:</label>
                                        <input type="date" id="fecha_pago" min="0" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-4">
                                        <label for="total_pendiente" class="form-label">Total pendiente:</label>
                                        <input type="number" id="total_pendiente" min="0" value="0" class="form-control">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="pago_cuota" class="form-label">Pago cuota:</label>
                                        <input type="number" id="pago_cuota" min="0" value="0" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- SECCION DE CREAR VENTA -->
                            <div class="row mb-3">
                                <button class="btn btn-block" style="background:#7367F0; color:white">
                                    <h5><i class="fa fa-plus fa-lg text-white me-2"></i> Crear venta</h5>
                                </button>
                            </div>

                            <!-- IMPRESION DIRECTO O DESCARGA -->
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <button class="btn" style="background: #28C76F; color: white">
                                        <i class="fa fa-print"></i> Imprimir
                                    </button>
                                </div>
                                <div class="col text-center">
                                    <button class="btn" style="background: #28C76F; color: white">
                                        <i class="fa fa-download"></i> Descargar
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_productos">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th>Código</th>
                                <th>Imagen</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_productos">

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


<!-- MODAL NUEVO CLIENTE -->
<div class="modal fade" id="modalNuevoClienteCompra" tabindex="-1" aria-labelledby="modalNuevoClienteLabel" aria-hidden="true">
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