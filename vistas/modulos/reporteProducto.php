<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Reporte de productos</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="table-top">

                    <div class="search-set">

                        <form id="form_mostrar_producto_stock">

                            <div class="form-group">

                                <div class="form-label">Mostrar productos por stock:</div>

                                <div class="input-group">

                                    <input type="number" id="show_sotck_reporte" class="form-control" placeholder="Ingresa la cantidad">
                                    
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" id="btn_mostrar_producto_stock" type="button">Ver reporte</button>
                                    </div>

                                </div>
                                <small id="error_show_sotck_reporte"></small>

                            </div>

                        </form>

                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" id="btn_descargar_reporte_producto" data-bs-placement="top" title="pdf"><img src="vistas/dist/assets/img/icons/pdf.svg" alt="img"></a>
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
                    <table class="table table-striped table-bordered" id="tabla_reporte_producto" style="width:100%">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Fecha V.</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="dataReporteProducto">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
