<!-- ========================================
CONTENIDO PRINCIPAL
======================================== -->

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de contratos de trabajador</h4>
                <h6>Administrar contratos</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoContratoTrabajador"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Crear contrato</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">

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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_contrato_trabajador">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Trabajador</th>
                                <th>Tiempo de contrato</th>
                                <th>Tipo de sueldo</th>
                                <th>Sueldo</th>
                                <th>Fecha</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="datos_contrato_trabajador">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- ========================================
MODAL NUEVO CONTRATO DEL TRABAJADOR
======================================== -->

<div class="modal fade" id="modalNuevoContratoTrabajador" tabindex="-1" aria-labelledby="modalNuevoContratoTrabajadorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo contrato del trabajador</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form enctype="multipart/form-data" id="form_nuevo_contrato_trabajador">

                <div class="modal-body">

                    <!-- INGRESO DE TRABAJADOR -->
                    <div class="form-group">

                        <label>Ingrese el nombre completo (<span class="text-danger">*</span>)</label>

                        <select id="id_trabajador_contrato" class="form-select form-select-sm">
                            <option selected disabled>Selecione</option>
                            <?php

                            $item = null;
                            $valor = null;

                            $trabajadores = ControladorTrabajador::ctrMostrarTrabajadores($item, $valor);
                            foreach ($trabajadores as $trabajador) {
                            ?>
                                <option value="<?php echo $trabajador["id_trabajador"] ?>"><?php echo $trabajador["nombre"] ?></option>
                            <?php
                            }
                            ?>

                        </select>

                        <small id="error_id_trabajador"></small>

                    </div>

                    <div class="row">


                        <!-- INGRESO DE TIEMPO DE CONTRATO -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="tiempo de contrato" class="form-label">Tiempo de contrato (<span class="text-danger">*</span>)</label>

                                <input type="number" id="tiempo_contrato_t" class="form-control" value="0" min="0">

                                <small id="error_tiempo_contrato"></small>

                            </div>
                        </div>

                        <!-- INGRESO DE TIPO DE SUELDO -->
                        <div class="col-md-6">

                            <label for="" class="form-label">Tipo de sueldo (<span class="text-danger">*</span>)</label>

                            <select id="tipo_sueldo_c" class="form-select form-select-sm">
                                
                                <option selected disabled>Seleccione</option>
                                <option value="diaria">Diario</option>
                                <option value="semanal">Semanal</option>
                                <option value="mensual">Mensual</option>

                            </select>

                            <small id="error_tipo_sueldo"></small>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3"></div>

                        <div class="col-md-6">

                            <label for="sueldo_t" class="form-label">Ingrese el sueldo (<span class="text-danger">*</span>)</label>

                            <input type="number" id="sueldo_trabajador" value="0.00" class="form-control">

                            <small id="error_sueldo_trabajador"></small>

                        </div>

                        <div class="col-md-3"></div>

                    </div>

                </div>

                <!-- BOTONES PARA GUARDAR Y CERRAR -->
                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_guardar_contrato_trabajador" class="btn btn-primary mx-2">Guardar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>


<!-- ========================================
MODAL EDITAR CONTRATO DEL TRABAJADOR
======================================== -->

<div class="modal fade" id="modalEditarContratoTrabajador" tabindex="-1" aria-labelledby="modalEditarContratoTrabajadorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar contrato del trabajador</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form enctype="multipart/form-data" id="form_editar_contrato_trabajador">

                <div class="modal-body">

                    <!-- ID CONTRATO -->
                    <input type="hidden" id="edit_id_contrato">

                    <!-- INGRESO DE TRABAJADOR -->
                    <div class="form-group">

                        <label>Ingrese el nombre completo (<span class="text-danger">*</span>)</label>

                        <select id="edit_id_trabajador_contrato" class="form-select form-select-sm">

                            <?php

                            $item = null;
                            $valor = null;

                            $trabajadores = ControladorTrabajador::ctrMostrarTrabajadores($item, $valor);
                            foreach ($trabajadores as $trabajador) {
                            ?>
                                <option value="<?php echo $trabajador["id_trabajador"] ?>"><?php echo $trabajador["nombre"] ?></option>
                            <?php
                            }
                            ?>

                        </select>

                        <small id="edit_error_id_trabajador"></small>

                    </div>

                    <div class="row">


                        <!-- INGRESO DE TIEMPO DE CONTRATO -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="tiempo de contrato" class="form-label">Tiempo de contrato (<span class="text-danger">*</span>)</label>

                                <input type="number" id="edit_tiempo_contrato_t" class="form-control" value="0" min="0">

                                <small id="edit_error_tiempo_contrato"></small>

                            </div>
                        </div>

                        <!-- INGRESO DE TIPO DE SUELDO -->
                        <div class="col-md-6">

                            <label for="" class="form-label">Tipo de sueldo (<span class="text-danger">*</span>)</label>

                            <select id="edit_tipo_sueldo_c" class="form-select form-select-sm">
                                
                                <option selected disabled>Seleccione</option>
                                <option value="diaria">Diario</option>
                                <option value="semanal">Semanal</option>
                                <option value="mensual">Mensual</option>

                            </select>

                            <small id="edit_error_tipo_sueldo"></small>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3"></div>

                        <div class="col-md-6">

                            <label for="sueldo_t" class="form-label">Ingrese el sueldo (<span class="text-danger">*</span>)</label>

                            <input type="number" id="edit_sueldo_trabajador" value="0.00" class="form-control">

                            <small id="edit_error_sueldo_trabajador"></small>

                        </div>

                        <div class="col-md-3"></div>

                    </div>

                </div>

                <!-- BOTONES PARA GUARDAR Y CERRAR -->
                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_actualizar_contrato_trabajador" class="btn btn-primary mx-2"><i class="fas fa-sync"></i> Guardar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>
