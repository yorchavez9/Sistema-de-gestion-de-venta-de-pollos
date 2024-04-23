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

                        <div class="form-group col-md-4">
                            <label for="quantity">Cantidad de códigos:</label>
                            <input type="number" id="quantity"  class="form-control" value="5">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="barWidth">Ancho de las barras:</label>
                            <input type="number" id="barWidth"  class="form-control" value="1.4" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="barHeight">Altura de las barras:</label>
                            <input type="number" id="barHeight" class="form-control"  value="60" readonly>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="button" class="btn" style="background: #7367F0; color: white" id="generate">Generar Códigos de Barras</button>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div id="barcodeContainer"></div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <a href="#" type="button" id="printBtnBarra" class="btn text-white mx-2" style="background: #28C76F;"><i class="fas fa-print"></i> Imprimir</a>
                    <button type="button" id="btnSalirCodigoBarra" class="btn" style="background: #FF4D4D; color: white" data-bs-dismiss="modal">Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>
