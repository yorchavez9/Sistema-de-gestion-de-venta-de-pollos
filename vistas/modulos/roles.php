<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de roles</h4>
                <h6>Administrar roles</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoRol"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar rol</a>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_rol">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_roles">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL NUEVO ROL -->
<div class="modal fade" id="modalNuevoRol" tabindex="-1" aria-labelledby="modalNuevoRolLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear rol</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_rol">
                <div class="modal-body">

                    <!-- INGRESO TIPO DE PROVEEDOR -->
                    <div class="form-group">
                        <label for="nombre_rol" class="form-label">Ingrese el nombre (<span class="text-danger">*</span>)</label>
                        <input type="text" name="nombre_rol" id="nombre_rol" placeholder="Ingresa el nombre del rol">
                        <small id="error_nombre_rol"></small>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_guardar_rol" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR ROL -->
<div class="modal fade" id="modalEditarRol" tabindex="-1" aria-labelledby="modalEditarRolLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Rol</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_actualizar_rol">
                <div class="modal-body">

                    <!-- ID ROL -->
                    <input type="hidden" name="edit_id_rol" id="edit_id_rol">

                    <!-- INGRESO NOMBRE -->
                    <div class="form-group">
                        <label for="nombre_categoria" class="form-label">Ingrese el nombre (<span class="text-danger">*</span>)</label>
                        <input type="text" name="edit_nombre_rol" id="edit_nombre_rol" placeholder="Ingresa el nombre">
                        <small id="edit_error_nombre_rol"></small>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_actualizar_rol" class="btn btn-primary mx-2"><i class="fas fa-sync"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>



