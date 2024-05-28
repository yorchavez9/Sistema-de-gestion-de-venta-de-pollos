<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4 class="mb-1">Configuración de impresora</h4>
                <h6>Administrar impresora</h6>
            </div>
            <div class="page-btn">
                <?php

                $item = null;
                $valor = null;

                $impresoras = ControladorImpresora::ctrMostrarImpresora($item, $valor);

                $contadorImpresoras = count($impresoras);

                if ($contadorImpresoras <= 0) {
                ?>
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoConfiguracionImpresora"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Crear configuración</a>

                <?php
                }
                ?>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_configuracion_impresora">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre de impresora</th>
                                <th>IP de la impresora</th>
                                <th>Fecha</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_configuracion_impresora">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL INGRESO DE CONFIGURACION DE LA IMPRESORA -->
<div class="modal fade" id="modalNuevoConfiguracionImpresora" tabindex="-1" aria-labelledby="modalNuevoConfiguracionImpresoraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configurar impresora</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_configuracion_impresora">

                <div class="modal-body">

                    <!-- INGRESO NOMBRE DE LA TIENDA -->
                    <div class="form-group">
                        <label for="nombre_empresa" class="form-label">Ingrese el nombre de la impresora:</label>
                        <input type="text" id="nombre_impresora" placeholder="Ingresa el nombre de la impresora">
                        <small id="error_nombre_impresora"></small>
                    </div>

                    <!-- INGRESO DEL TELÉFONO -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el IP de la impresora:</label>
                        <input type="text" id="ip_impresora" class="form-control" placeholder="Ingrese el IP de la impresora">
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_guardar_configuracion_impresora" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- MODAL EDITAR DE CONFIGURACION DE LA IMPRESORA -->
<div class="modal fade" id="modalEditarConfiguracionImpresora" tabindex="-1" aria-labelledby="modalNuevoConfiguracionImpresoraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configurar impresora</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_impresora_configuracion_impresora">

                <div class="modal-body">


                    <!-- ID DE LA IMPRESORA -->
                    <input type="text" id="id_impresora_edit">

                    <!-- INGRESO NOMBRE DE LA TIENDA -->
                    <div class="form-group">
                        <label for="nombre_empresa" class="form-label">Ingrese el nombre de la impresora:</label>
                        <input type="text" id="edit_nombre_impresora" placeholder="Ingresa el nombre de la impresora">
                        <small id="edit_error_nombre_impresora"></small>
                    </div>

                    <!-- INGRESO DEL TELÉFONO -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el IP de la impresora:</label>
                        <input type="text" id="edit_ip_impresora" class="form-control" placeholder="Ingrese el IP de la impresora">
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_actualizar_configuracion_impresora" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </form>

        </div>
    </div>
</div>
