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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_usuarios">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>N° documento</th>
                                <th>Dirección</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="dataUsuarios">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL CREAR VACACIONES -->
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
                        <select class="select" id="id_doc">
                            <option disabled selected>Seleccione</option>
                            <?php
                            foreach ($trabajadores as $key => $trabajador) {
                            ?>
                                <option value="<?php echo $trabajador["id_trabajador"] ?>"><?php echo $trabajador["nombre"] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <small id="errorTipoDocumento"></small>
                    </div>


                    <div class="row">

                        <!-- INGRESO DE FECHA DE INICIO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Fecha de inicio (<span class="text-danger">*</span>)</label>
                                <input type="date" id="direccion" class="form-control">
                                <small id="errorDireccionUsuario"></small>
                            </div>

                        </div>


                        <!-- INGRESO DE FECHA DE FIN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Fecha de fin (<span class="text-danger">*</span>)</label>
                                <input type="date" id="telefono" class="form-control">
                                <small id="errorTelefonoUsuario"></small>
                            </div>

                        </div>
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_guardar_vacaciones" class="btn btn-primary mx-2">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
