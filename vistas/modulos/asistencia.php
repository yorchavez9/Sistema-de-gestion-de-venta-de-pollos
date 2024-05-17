<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de asistencia</h4>
                <h6>Administrar asistencia</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoAsistencia"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar asistencia</a>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_asistencia">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Fecha</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_mostrar_asistencias">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- ===============================
MODAL NUEVA ASISTENCIA
=============================== -->
<div class="modal fade" id="modalNuevoAsistencia" tabindex="-1" aria-labelledby="modalNuevoAsistenciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear asistencia de trabajadores</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_asistencia">

                <div class="modal-body">

                    <div class="row mb-3">

                        <div class="col-md-4">

                            <label for="fecha_asistencia" class="form-label">Fecha (<span class="text-danger">*</span>)</label>

                            <input type="date" id="fecha_asistencia_a" class="form-control">

                        </div>

                        <div class="col-md-4">

                            <label for="hora_entrada" class="form-label">Hora entrada (<span class="text-danger">*</span>)</label>

                            <input type="time" id="hora_entrada_a" class="form-control">

                        </div>

                        <div class="col-md-4">

                            <label for="hora-salida" class="form-label">Hola salida (<span class="text-danger">*</span>)</label>

                            <input type="time" id="hora_salida_a" class="form-control">

                        </div>

                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Trabajador</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-center">Observación</th>
                            </tr>
                        </thead>
                        <tbody id="show_estado_asistencia">
                            <?php
                            $item = null;
                            $valor = null;

                            $trabajadores = ControladorTrabajador::ctrMostrarTrabajadoresAsistencia($item, $valor);

                            $contador = 1;

                            foreach ($trabajadores as $trabajador) {

                                // Verificar si la clave 'asistencia' existe
                                $asistencia = isset($trabajador['asistencia']) ? $trabajador['asistencia'] : '';

                            ?>
                                <tr>
                                    <th scope="row"><?php echo $contador ?></th>
                                    <td><?php echo $trabajador["nombre"] ?> <input type="hidden" id="id_trabajador_asistencia" value="<?php echo $trabajador["id_trabajador"]?>" ></td>
                                    <td class="text-center">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="asistencia<?php echo $contador ?>" id="presente<?php echo $contador ?>" value="Presente" <?php if ($asistencia == 'Presente') echo 'checked' ?>>
                                            <label class="form-check-label" style="color: #28C76F" for="presente<?php echo $contador ?>">Presente</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="asistencia<?php echo $contador ?>" id="tarde<?php echo $contador ?>" value="Tarde" <?php if ($asistencia == 'Tarde') echo 'checked' ?>>
                                            <label class="form-check-label" style="color: #FF9F43" for="tarde<?php echo $contador ?>">Tarde</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="asistencia<?php echo $contador ?>" id="falta<?php echo $contador ?>" value="Falta" <?php if ($asistencia == 'Falta') echo 'checked' ?>>
                                            <label class="form-check-label" style="color: #FF4D4D" for="falta<?php echo $contador ?>">Falta</label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="observacion_asistencia<?php echo $contador ?>" placeholder="Observación">
                                    </td>
                                </tr>
                            <?php
                                $contador++;
                            }
                            ?>
                        </tbody>
                    </table>



                </div>

                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_guardar_asistencia" class="btn btn-primary mx-2"><i class="fas fa-save"></i> Guardar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>

<!-- ===============================
MODAL EDITAR ASISTENCIA
=============================== -->
<div class="modal fade" id="modalEditarAsistencia" tabindex="-1" aria-labelledby="modalEditarAsistenciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear asistencia de trabajadores</h5>
                <button type="button"  class="close close_modal_asistencia" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_editar_asistencia">

                <div class="modal-body">

                    <div class="row mb-3">
                        

                        <!-- INGRESO DE FECHA  -->
                        <div class="col-md-4">

                            <label for="fecha_asistencia" class="form-label">Fecha (<span class="text-danger">*</span>)</label>

                            <input type="date" id="edit_fecha_asistencia_a" readonly class="form-control">

                        </div>

                        <!-- INGRESO DE HORA DE ENTRADA -->
                        <div class="col-md-4">

                            <label for="hora_entrada" class="form-label">Hora entrada (<span class="text-danger">*</span>)</label>

                            <input type="time" id="edit_hora_entrada_a" class="form-control">

                        </div>

                        <!-- INGRESO DE HORA DE SALIDA -->
                        <div class="col-md-4">

                            <label for="hora-salida" class="form-label">Hora salida (<span class="text-danger">*</span>)</label>

                            <input type="time" id="edit_hora_salida_a" class="form-control">

                        </div>

                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Trabajador</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-center">Observación</th>
                            </tr>
                        </thead>
                        
                        <tbody id="edit_show_estado_asistencia">
                            
                        </tbody>
                    </table>



                </div>

                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_guardar_asistencia" class="btn btn-primary mx-2"><i class="fas fa-save"></i> Guardar</button>

                    <button type="button" class="btn btn-secondary close_modal_asistencia" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>

<!-- ===============================
MODAL VER ASISTENCIA
=============================== -->
<div class="modal fade" id="modalVerAsistencia" tabindex="-1" aria-labelledby="modalVerAsistenciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear asistencia de trabajadores</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_asistencia">

                <div class="modal-body">

                    <div class="row mb-3">

                        <div class="col-md-4">

                            <label for="fecha_asistencia" class="form-label">Fecha (<span class="text-danger">*</span>)</label>

                            <input type="date" id="fecha_asistencia_a" class="form-control">

                        </div>

                        <div class="col-md-4">

                            <label for="hora_entrada" class="form-label">Hora entrada (<span class="text-danger">*</span>)</label>

                            <input type="time" id="hora_entrada_a" class="form-control">

                        </div>

                        <div class="col-md-4">

                            <label for="hora-salida" class="form-label">Hola salida (<span class="text-danger">*</span>)</label>

                            <input type="time" id="hora_salida_a" class="form-control">

                        </div>

                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Trabajador</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-center">Observación</th>
                            </tr>
                        </thead>
                        <tbody id="show_estado_asistencia">
                            <?php
                            $item = null;
                            $valor = null;

                            $trabajadores = ControladorTrabajador::ctrMostrarTrabajadoresAsistencia($item, $valor);

                            $contador = 1;

                            foreach ($trabajadores as $trabajador) {

                                // Verificar si la clave 'asistencia' existe
                                $asistencia = isset($trabajador['asistencia']) ? $trabajador['asistencia'] : '';

                            ?>
                                <tr>
                                    <th scope="row"><?php echo $contador ?></th>
                                    <td><?php echo $trabajador["nombre"] ?> <input type="hidden" id="id_trabajador_asistencia" value="<?php echo $trabajador["id_trabajador"]?>" ></td>
                                    <td class="text-center">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="asistencia<?php echo $contador ?>" id="presente<?php echo $contador ?>" value="Presente" <?php if ($asistencia == 'Presente') echo 'checked' ?>>
                                            <label class="form-check-label" style="color: #28C76F" for="presente<?php echo $contador ?>">Presente</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="asistencia<?php echo $contador ?>" id="tarde<?php echo $contador ?>" value="Tarde" <?php if ($asistencia == 'Tarde') echo 'checked' ?>>
                                            <label class="form-check-label" style="color: #FF9F43" for="tarde<?php echo $contador ?>">Tarde</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="asistencia<?php echo $contador ?>" id="falta<?php echo $contador ?>" value="Falta" <?php if ($asistencia == 'Falta') echo 'checked' ?>>
                                            <label class="form-check-label" style="color: #FF4D4D" for="falta<?php echo $contador ?>">Falta</label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="observacion_asistencia<?php echo $contador ?>" placeholder="Observación">
                                    </td>
                                </tr>
                            <?php
                                $contador++;
                            }
                            ?>
                        </tbody>
                    </table>



                </div>

                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_guardar_asistencia" class="btn btn-primary mx-2"><i class="fas fa-save"></i> Guardar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>
