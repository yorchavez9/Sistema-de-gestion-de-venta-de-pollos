<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de vacaciones</h4>
                <h6>Administrar vacaciones</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoVacaciones"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar vacaciones</a>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_vacaciones">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_mostrar_vacaciones">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- ===============================
MODAL CREAR VACACIONES
=============================== -->
<div class="modal fade" id="modalNuevoVacaciones" tabindex="-1" aria-labelledby="modalNuevoVacacionesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nueva vacación</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_vacaciones">

                <div class="modal-body">

                    <!-- INGRESO DEL TRABAJADOR -->

                    <div class="form-group">
                        <label class="form-label">Selecione el trabajador(<span class="text-danger">*</span>)</label>
                        <?php

                        $item = null;

                        $valor = null;

                        $trabajadores = ControladorTrabajador::ctrMostrarTrabajadores($item, $valor);

                        ?>
                        <select class="select" id="id_trabajador_v">
                            <option disabled selected>Seleccione</option>
                            <?php
                            foreach ($trabajadores as $key => $trabajador) {
                            ?>
                                <option value="<?php echo $trabajador["id_trabajador"] ?>"><?php echo $trabajador["nombre"] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <small id="error_id_trabajador_v"></small>
                    </div>


                    <div class="row">

                        <!-- INGRESO DE FECHA DE INICIO -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="fecha_inicio_v" class="form-label">Fecha de inicio (<span class="text-danger">*</span>)</label>

                                <input type="date" id="fecha_inicio_v" class="form-control">

                                <small id="error_fecha_inicio_v"></small>

                            </div>

                        </div>


                        <!-- INGRESO DE FECHA DE FIN -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="fecha_fin_v" class="form-label">Fecha de fin (<span class="text-danger">*</span>)</label>

                                <input type="date" id="fecha_fin_v" class="form-control">

                                <small id="error_fecha_fin_v"></small>

                            </div>

                        </div>
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_guardar_vacacion" class="btn btn-primary mx-2"><i class="fas fa-save"></i> Guardar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>

<!-- ===============================
MODAL EDITAR VACACIONES
=============================== -->
<div class="modal fade" id="modalEditarVacaciones" tabindex="-1" aria-labelledby="modalEditarVacacionesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nueva vacación</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_actualizar_vacaciones">

                <div class="modal-body">

                    <!-- ID VACACIONES -->
                    <input type="text" id="edit_id_vacaciones">
                            
                    <!-- INGRESO DEL TRABAJADOR -->

                    <div class="form-group">
                        <label class="form-label">Selecione el trabajador(<span class="text-danger">*</span>)</label>
                        <?php

                        $item = null;

                        $valor = null;

                        $trabajadores = ControladorTrabajador::ctrMostrarTrabajadores($item, $valor);

                        ?>
                        <select class="form-select" id="edit_id_trabajador_v">
                            <option disabled selected>Seleccione</option>
                            <?php
                            foreach ($trabajadores as $key => $trabajador) {
                            ?>
                                <option value="<?php echo $trabajador["id_trabajador"] ?>"><?php echo $trabajador["nombre"] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <small id="edit_error_id_trabajador_v"></small>
                    </div>


                    <div class="row">

                        <!-- INGRESO DE FECHA DE INICIO -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="fecha_inicio_v" class="form-label">Fecha de inicio (<span class="text-danger">*</span>)</label>

                                <input type="date" id="edit_fecha_inicio_v" class="form-control">

                                <small id="edit_error_fecha_inicio_v"></small>

                            </div>

                        </div>


                        <!-- INGRESO DE FECHA DE FIN -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="fecha_fin_v" class="form-label">Fecha de fin (<span class="text-danger">*</span>)</label>

                                <input type="date" id="edit_fecha_fin_v" class="form-control">

                                <small id="edit_error_fecha_fin_v"></small>

                            </div>

                        </div>
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_actualizar_vacacion" class="btn btn-primary mx-2"><i class="fas fa-sync-alt"></i> Actualizar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>
