<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Configuración del ticket</h4>
                <h6>Administrar ticket</h6>
            </div>
            <div class="page-btn">
                <?php

                $item = null;
                $valor = null;

                $tickets = ControladorConfiguracionTicket::ctrMostrarConfiguracionTicket($item, $valor);

                $contadorTickets = count($tickets);

                if ($contadorTickets <= 0) {
                ?>
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoConfiguracionTicket"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Crear configuración</a>

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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_configuracion_ticket">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre tienda</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>logo</th>
                                <th>Mensaje</th>
                                <th>Fecha</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_configuracion_ticket">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL INGRESO DE CONFIGURACION DE TICKET -->
<div class="modal fade" id="modalNuevoConfiguracionTicket" tabindex="-1" aria-labelledby="modalNuevoConfiguracionTicketLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configurar Ticket</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_configuracion_ticket">

                <div class="modal-body">

                    <!-- INGRESO NOMBRE DE LA TIENDA -->
                    <div class="form-group">
                        <label for="nombre_empresa" class="form-label">Ingrese el nombre:</label>
                        <input type="text" name="nombre_empresa_ticket" id="nombre_empresa_ticket" placeholder="Ingresa el el nombre de la tienda">
                    </div>

                    <!-- INGRESO DEL TELÉFONO -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el teléfono:</label>
                        <input type="text" id="telefono_ticket" class="form-control" placeholder="Ingrese el teléfono">
                    </div>

                    <!-- INGRESO DE CORREO -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el correo:</label>
                        <input type="text" id="correo_ticket" class="form-control" placeholder="Ingrese el correo">
                    </div>

                    <!-- INGRESO DE DIRECCION -->
                    <div class="form-group">
                        <label class="form-label">Ingrese la dirección:</label>
                        <input type="text" id="direccion_ticket" class="form-control" placeholder="Ingrese la dirección">
                    </div>

                    <!-- INGRESO LOGO -->
                    <div class="form-group">
                        <label class="form-label">Selecione una imagen:</label>
                        <input type="file" id="logo_ticket" class="form-control">
                        <div class="text-center mt-2">
                            <img src="" id="vista_previa_logo_ticket" class="img img-fluid" alt="" style="min-width: 100px; min-height: 100px;">
                        </div>

                    </div>

                    <!-- INGRESO DE MENSAJE -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el mensaje:</label>
                        <textarea id="mensaje_ticket" cols="30" rows="10" placeholder="Ingrese el mensaje"></textarea>
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_guardar_configuracion_ticket" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- MODAL INGRESO DE CONFIGURACION DE TICKET -->
<div class="modal fade" id="modalEditarConfiguracionTicket" tabindex="-1" aria-labelledby="modalNuevoConfiguracionTicketLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear categoría</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_edit_configuracion_ticket">

                <div class="modal-body">

                    <!-- ID DEL TICKET -->
                    <input type="hidden" id="edit_id_config_ticket">

                    <!-- INGRESO NOMBRE DE LA TIENDA -->
                    <div class="form-group">
                        <label for="nombre_empresa" class="form-label">Ingrese el nombre:</label>
                        <input type="text" name="edit_nombre_empresa_ticket" id="edit_nombre_empresa_ticket" placeholder="Ingresa el el nombre de la tienda">
                    </div>

                    <!-- INGRESO DEL TELÉFONO -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el teléfono:</label>
                        <input type="text" id="edit_telefono_ticket" class="form-control" placeholder="Ingrese el teléfono">
                    </div>

                    <!-- INGRESO DE CORREO -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el correo:</label>
                        <input type="text" id="edit_correo_ticket" class="form-control" placeholder="Ingrese el correo">
                    </div>

                    <!-- INGRESO DE DIRECCION -->
                    <div class="form-group">
                        <label class="form-label">Ingrese la dirección:</label>
                        <input type="text" id="edit_direccion_ticket" class="form-control" placeholder="Ingrese la dirección">
                    </div>

                    <!-- INGRESO LOGO -->
                    <div class="form-group">
                        <label class="form-label">Selecione una imagen:</label>
                        <input type="file" id="edit_logo_ticket" class="form-control">
                        <div class="text-center mt-2">
                            <img src="" id="edit_vista_previa_logo_ticket" class="img img-fluid" alt="" style="min-width: 100px; min-height: 100px;">
                        </div>
                        <input type="hidden" id="edit_foto_actual_ticket">
                    </div>

                    <!-- INGRESO DE MENSAJE -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el mensaje:</label>
                        <textarea id="edit_mensaje_ticket" cols="30" rows="10" placeholder="Ingrese el mensaje"></textarea>
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_update_configuracion_ticket" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </form>

        </div>
    </div>
</div>
