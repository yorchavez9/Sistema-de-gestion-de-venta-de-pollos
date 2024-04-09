<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de compras</h4>
                <h6>Administrar compras</h6>
            </div>
            <div class="page-btn">
                <a href="compras" class="btn btn-added"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Nueva compra</a>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_lista_agreso">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>Serie</th>
                                <th>Número</th>
                                <th>Tipo pago</th>
                                <th>Total compra</th>
                                <th>Total restante</th>
                                <th class="text-center">Estado pago</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_lista_egresos">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL NUEVO PRODUCTO -->
<div class="modal fade" id="modalNuevoProducto" tabindex="-1" aria-labelledby="modalNuevoProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo producto <i class="fas fa-box"></i></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_producto">
                <div class="modal-body">

                    <div class="row">

                        <!-- INGRESOO DE LA CATEGORIA -->
                        <div class="col-md-6">
                            <label class="form-label">Selecione la categoría (<span class="text-danger">*</span>)</label>
                            <?php
                            $item = null;
                            $valor = null;
                            $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                            ?>
                            <select class="select" id="id_categoria_P">
                                <option disabled selected>Seleccione</option>
                                <?php
                                foreach ($categorias as $key => $categoria) {
                                ?>
                                    <option value="<?php echo $categoria["id_categoria"] ?>"><?php echo $categoria["nombre_categoria"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <small id="error_id_categoria_p"></small>
                        </div>

                        <!-- INGRESO DE DEL CODIGO  -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo" class="form-label">Ingrese el código del producto (<span class="text-danger">*</span>)</label>
                                <input type="text" id="codigo_producto" placeholder="Ingrese el código del producto">
                                <small id="error_codigo_p"></small>
                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- INGRESO DE NOMBRE  -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese el nombre del producto (<span class="text-danger">*</span>)</label>
                                <input type="text" id="nombre_producto" placeholder="Ingrese el nombre del producto">
                                <small id="error_nombre_p"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE STOCK -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="stock" class="form-label">Stock (<span class="text-danger">*</span>)</label>
                                <input type="number" id="stock_producto" value="0" class="form-control">
                                <small id="error_stock_p"></small>
                            </div>

                        </div>

                        <!-- INGRESO DE FECHA DE VENCIMIENTO -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="fecha_vencimiento" class="form-label">Ingrese la fecha de vencimiento</label>
                                <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control">
                                <small id="error_fecha_vencimiento_p"></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion_producto" class="form-label"> Ingrese la descripción</label>
                        <textarea name="descripcion_producto" id="descripcion_producto" cols="30" rows="10" placeholder="Ingrese la descripción del producto"></textarea>
                    </div>

                    <!-- INGRESO DE LA IMAGEN -->
                    <div class="form-group">
                        <label for="imagen_producto" class="form-label">Selecione la imagen</label>
                        <input type="file" class="form-control" id="imagen_producto">
                        <div class="text-center mt-3">
                            <img src="" class="vistaPreviaImagenProducto img img-fluid" width="250" alt="">
                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_guardar_producto" class="btn btn-primary mx-2">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
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
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese el nombre del producto (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_nombre_producto" placeholder="Ingrese el nombre del producto">
                                <small id="edit_error_nombre_p"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE STOCK -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="stock" class="form-label">Stock (<span class="text-danger">*</span>)</label>
                                <input type="number" id="edit_stock_producto" value="0" class="form-control form-control">
                                <small id="edit_error_stock_p"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE FECHA DE VENCIMIENTO -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="fecha_vencimiento" class="form-label">Ingrese la fecha de vencimiento</label>
                                <input type="date" id="edit_fecha_vencimiento" name="edit_fecha_vencimiento" class="form-control">
                                <small id="edit_error_fecha_vencimiento_p"></small>
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



<!-- MODAL PAGAR COMPRA -->
<div class="modal fade" id="modalPagarCompra" tabindex="-1" aria-labelledby="modalPagarCompraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pagar deuda</h5>
                <button type="button" class="close btn_modal_ver_close_usuario" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="frm_pagar_deuda">
                <div class="modal-body">
                
                    <input type="hidden" id="id_egreso_pagar" name="id_egreso_pagar">

                    <div class="row">
                        <div class="col-md-6">
                            <!-- COMPRA TOTAL -->
                            <div class="form-group">
                                <label><i class="fas fa-money-bill" style="color: #28C76F"></i> Compra total:</label>
                                <h3 class="fw-bold" id="total_compra_show"></h3>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-money-bill" style="color: #28C76F"></i> Total restante:</label>
                                <h3 class="fw-bold text-warning" id="total_restante_show"></h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- FECHA DE PAGO -->
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-barcode text-danger"></i> Monto a pagar:</label>
                            <input type="text" id="monto_pagar_compra" name="monto_pagar_compra" class="form-control" placeholder="Ingrese el monto a pagar">
                            <small id="error_monto_pagar_egreso"></small>
                        </div>

                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" class="btn btn-primary" id="btn_pagar_deuda_egreso"><i class="fa fa-save"></i> Pagar</button>
                    <button type="button" class="btn btn-secondary btn_modal_ver_close_usuario" data-bs-dismiss="modal"> Cerrar</button>
                </div>
            </form>


        </div>
    </div>
</div>