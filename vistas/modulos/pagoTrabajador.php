<!-- ========================================
CONTENIDO PRINCIPAL
======================================== -->

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de pago de trabajadores</h4>
                <h6>Administrar pago de trabajadores</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoPagoTrabajador"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2"> Nuevo pago</a>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_pago_trabajador">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Trabajador</th>
                                <th>Monto a pagar</th>
                                <th>Próximo pago</th>
                                <th>Estado</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="datos_pago_trabajador">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- ========================================
MODAL NUEVO PAGO DEL TRABAJADOR
======================================== -->

<div class="modal fade" id="modalNuevoPagoTrabajador" tabindex="-1" aria-labelledby="modalNuevoPagoTrabajadorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo pago</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form enctype="multipart/form-data" id="form_nuevo_pago_trabajador">

                <div class="modal-body">

                    <!-- INGRESO DE TRABAJADOR -->
                    <div class="form-group">

                        <label>Selecione el trabajador (<span class="text-danger">*</span>)</label>

                        <select id="id_contrato_pago" class="form-select form-select-sm">
                            <option selected disabled>Selecione</option>
                            <?php

                            $item = null;
                            $valor = null;

                            $contratos = ControladorContrato::ctrMostrarContratos($item, $valor);

                            foreach ($contratos as $contrato) {
                            ?>
                                <option value="<?php echo $contrato["id_contrato"] ?>"><?php echo $contrato["nombre"] ?></option>
                            <?php
                            }
                            ?>

                        </select>

                        <small id="error_id_trabjador_pago"></small>

                    </div>

                    <div class="row">



                        <!-- INGRESO DEL MONTO DE PAGO -->
                        <div class="col-md-6">

                            <label for="" class="form-label">Monto de pago (<span class="text-danger">*</span>)</label>

                            <input type="number" id="monto_pago_t" class="form-control" value="0" min="0">

                            <small id="error_tipo_sueldo"></small>

                        </div>


                        <!-- INGRESO DE TIEMPO DE CONTRATO -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="tiempo de contrato" class="form-label">Fecha de próximo pago (<span class="text-danger">*</span>)</label>

                                <input type="date" id="fecha_pago_t" class="form-control">

                                <small id="error_tiempo_contrato"></small>

                            </div>
                        </div>


                    </div>


                </div>

                <!-- BOTONES PARA GUARDAR Y CERRAR -->
                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_guardar_pago_trabajador" class="btn btn-primary mx-2">Generar pago</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>


<!-- ========================================
MODAL NUEVO PAGO DEL TRABAJADOR
======================================== -->

<div class="modal fade" id="modalNuevoPagoTrabajador" tabindex="-1" aria-labelledby="modalNuevoPagoTrabajadorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo pago</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form enctype="multipart/form-data" id="form_nuevo_pago_trabajador">

                <div class="modal-body">

                    <!-- INGRESO DE TRABAJADOR -->
                    <div class="form-group">

                        <label>Selecione el trabajador (<span class="text-danger">*</span>)</label>

                        <select id="id_contrato_pago" class="form-select form-select-sm">
                            <option selected disabled>Selecione</option>
                            <?php

                            $item = null;
                            $valor = null;

                            $contratos = ControladorContrato::ctrMostrarContratos($item, $valor);

                            foreach ($contratos as $contrato) {
                            ?>
                                <option value="<?php echo $contrato["id_contrato"] ?>"><?php echo $contrato["nombre"] ?></option>
                            <?php
                            }
                            ?>

                        </select>

                        <small id="error_id_trabjador_pago"></small>

                    </div>

                    <div class="row">



                        <!-- INGRESO DEL MONTO DE PAGO -->
                        <div class="col-md-6">

                            <label for="" class="form-label">Monto de pago (<span class="text-danger">*</span>)</label>

                            <input type="number" id="monto_pago_t" class="form-control" value="0" min="0">

                            <small id="error_tipo_sueldo"></small>

                        </div>


                        <!-- INGRESO DE TIEMPO DE CONTRATO -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="tiempo de contrato" class="form-label">Fecha de próximo pago (<span class="text-danger">*</span>)</label>

                                <input type="date" id="fecha_pago_t" class="form-control">

                                <small id="error_tiempo_contrato"></small>

                            </div>
                        </div>


                    </div>


                </div>

                <!-- BOTONES PARA GUARDAR Y CERRAR -->
                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_guardar_pago_trabajador" class="btn btn-primary mx-2">Generar pago</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>
