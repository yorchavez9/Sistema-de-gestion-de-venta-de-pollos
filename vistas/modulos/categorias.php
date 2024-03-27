<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de categorias</h4>
                <h6>Administrar categorias</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoCategoria"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar categoría</a>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_categoria">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="dataCategorias">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL NUEVO CATEGORIA -->
<div class="modal fade" id="modalNuevoCategoria" tabindex="-1" aria-labelledby="modalNuevoCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear categoría</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_categoria">
                <div class="modal-body">

                    <!-- INGRESO TIPO DE PROVEEDOR -->
                    <div class="form-group">
                        <label for="nombre_categoria" class="form-label">Ingrese el nombre (<span class="text-danger">*</span>)</label>
                        <input type="text" name="nombre_categoria" id="nombre_categoria" placeholder="Ingresa el nombre">
                        <small id="error_nombre_categoria"></small>
                    </div>

                    <!-- INGRESO DE RAZÓN SOCIAL -->
                    <div class="form-group">
                        <label class="form-label">Ingrese la descripción (<span class="text-danger">*</span>)</label>
                        <textarea name="descripcion_categoria" id="descripcion_categoria" cols="30" rows="10" placeholder="Ingrese la descripción"></textarea>
                        <small id="error_descripcion_categoria"></small>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_guardar_categoria" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR CATEGORIA -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar categoría</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_actualizar_categoria">
                <div class="modal-body">

                    <!-- ID CATEGORIA -->
                    <input type="hidden" name="edit_id_categoria" id="edit_id_categoria">
                    <!-- INGRESO TIPO DE PROVEEDOR -->
                    <div class="form-group">
                        <label for="nombre_categoria" class="form-label">Ingrese el nombre (<span class="text-danger">*</span>)</label>
                        <input type="text" name="edit_nombre_categoria" id="edit_nombre_categoria" placeholder="Ingresa el nombre">
                        <small id="edit_error_nombre_categoria"></small>
                    </div>

                    <!-- INGRESO DE RAZÓN SOCIAL -->
                    <div class="form-group">
                        <label class="form-label">Ingrese la descripción (<span class="text-danger">*</span>)</label>
                        <textarea name="edit_descripcion_categoria" id="edit_descripcion_categoria" cols="30" rows="10" placeholder="Ingrese la descripción"></textarea>
                        <small id="edit_error_descripcion_categoria"></small>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_actualizar_categoria" class="btn btn-primary mx-2"><i class="fas fa-sync"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>



