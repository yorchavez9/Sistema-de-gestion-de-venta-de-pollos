<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de tipos de documento</h4>
                <h6>Administrar tipo de documentos</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoTipoDocumento"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar tipo de documento</a>
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
                    <table class="table  datanew" id="tabla_tipo_documento">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre documento</th>
                                <th>Fecha</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="dataTipoDocumentos">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL NUEVO TIPOD DE DOCUMENTO -->
<div class="modal fade" id="modalNuevoTipoDocumento" tabindex="-1" aria-labelledby="modalNuevoTipoDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo tipo de documento</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="nuevoTipoDocumento">
                <div class="modal-body">

                    <!-- INGRESO DE TIPO DE DOCUMENTO -->
                    <div class="form-group">
                        <label>Ingrese el nombre del tipo de documento (<span class="text-danger">*</span>)</label>
                        <input type="text" name="nombre_tipo_documento" id="nombre_tipo_documento" placeholder="Ingrese el nombre del tipo de documento">
                        <small id="errorNombreTipoDocumento"></small>
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="guardar_tipo_documento" class="btn btn-primary mx-2">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL EDITAR TIPO DE DOCUMENTO -->
<div class="modal fade" id="modalEditarTipoDocumento" tabindex="-1" aria-labelledby="modalTipoDocumentoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar el tipo de documento</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="formEditTipoDocumento">
                <div class="modal-body">

                    <!-- ID -->
                    <div class="-form-group">
                        <input type="hidden" id="edit_id_doc">
                    </div>
                    <!-- INGRESO DE TIPO DE DOCUMENTO -->
                    <div class="form-group">
                        <label>Ingrese el nombre del tipo de documento (<span class="text-danger">*</span>)</label>
                        <input type="text" name="edit_nombre_tipo_documento" id="edit_nombre_tipo_documento">
                        <small id="errorNombreTipoDocumento"></small>
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="editar_tipo_documento" class="btn btn-primary mx-2">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

