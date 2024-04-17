<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Imprimir código de barra</h4>
                <h6>Admistrar el código de barra</h6>
            </div>
            <div class="page-btn">
                <a href="productos" class="btn btn-added"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Administrar producto</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_productos_codigo_barra">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th>Código</th>
                                <th class="text-center">Imagen</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Fecha v.</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_productos_codigo_barra">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- CREAR CODIGOS DE BARRA -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Creando código de barra <i class="fa fa-barcode me-2"></i></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_editar_producto">
                <div class="modal-body">

                    <!-- ID PRODUCTO -->
                    <input type="hidden" id="id_producto_codigo_barrar">

                    <div class="row">

                        <!-- INGRESOO DE LA CATEGORIA -->
                        <div class="col-md-6">
                            <label class="form-label">Nombre del producto: </label>
                            <p class="fw-bold" id="show_data_nombre_producto"></p>
                        </div>

                        <!-- INGRESO DE DEL CODIGO  -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo" class="form-label">Código del producto: </label>
                                <p class="fw-bold" id="show_data_codigo_producto"></p>
                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- INGRESO DE NOMBRE  -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Cantidad de códigos (<span class="text-danger">*</span>)</label>
                                <input type="number" id="cantidad_codigo_barra" placeholder="Cantidad de códigos" class="form-control">
                                <small id="edit_error_nombre_p"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE STOCK -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stock" class="form-label">Altura (<span class="text-danger">*</span>)</label>
                                <input type="number" id="altura_codigo_barra" placeholder="Altura" class="form-control">
                                <small id="edit_error_stock_p"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE FECHA DE VENCIMIENTO -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_vencimiento" class="form-label">Ancho (<span class="text-danger">*</span>)</label>
                                <input type="number" id="ancho_codigo_barra" placeholder="Ancho" name="edit_fecha_vencimiento" class="form-control">
                                <small id="edit_error_fecha_vencimiento_p"></small>
                            </div>
                        </div>

                    </div>

                    <div class="row" id="section_btn_">
                        <div class="col-md-4"></div>

                        <div class="col-md-4">
                            <button type="button" id="btn_generar_codigo_producto" class="btn mx-2 text-white" style="background: #7367F0"><i class="fas fa-barcode"></i> Generar código de barra</button>
                        </div>

                        <div class="col-md-4"></div>
                    </div>
                    <div  id="lista_codigo_barra">
                       
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_actualizar_producto" class="btn text-white mx-2" style="background: #28C76F;"><i class="fas fa-print"></i> Imprimir</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
