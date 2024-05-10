
<!-- ========================================
CONTENIDO PRINCIPAL
======================================== -->

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de trabajadores</h4>
                <h6>Administrar trabajadores</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoTrabajador"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar trabajador</a>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_trabajadores">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>N° documento</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>CV</th>
                                <th>Tipo Pago</th>
                                <th>Estado</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="datos_trabajadores">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- ========================================
MODAL NUEVO TRABAJADOR
======================================== -->

<div class="modal fade" id="modalNuevoTrabajador" tabindex="-1" aria-labelledby="modalNuevoTrabajadorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo trabajador</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form enctype="multipart/form-data" id="form_nuevo_trabajador">

                <div class="modal-body">

                    <!-- INGRESO DE NOMBRE -->
                    <div class="form-group">
                        <label>Ingrese el nombre completo (<span class="text-danger">*</span>)</label>
                        <input type="text" id="nombre_t" placeholder="Ingrese el nombre completo">
                        <small id="error_nombre_t"></small>
                    </div>

                    <div class="row">

                        <!-- INGRESO DE NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="numero_documento_t" placeholder="Ingrese el número de documento" minlength="8" required>
                                <small id="error_numero_documento_t"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese teléfono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="telefono_t" placeholder="Ingrese el teléfono">
                                <small id="error_telefono_t"></small>
                            </div>

                        </div>
                    </div>


                    <!-- INGRESO DE CORREO -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Ingrese el correo electrónico(<span class="text-danger">*</span>)</label>
                        <input type="email" id="correo_t" class="form-control" placeholder="Ingrese el correo electrónico">
                        <small id="error_correo_t"></small>
                    </div>


                    <div class="row">

                        <!-- INGRESO DE FOTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_trabajador" class="form-label">Ingrese la foto</label>
                                <input type="file" class="form-control" id="foto_t" class="form-control foto_t" accept="image/*">
                                <div class="text-center mt-3">
                                    <img src="" class="vista_previa_foto_trabajador img img-fluid rounded-circle" width="250" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- INGRESO DE CV PDF -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cv_trabajador" class="form-label">Ingrese el CV</label>
                                <input type="file" class="form-control" id="cv_t" accept="application/pdf">
                                <div class="text-center mt-3">
                                    <img src="vistas/pdf/pdf.png" style="display: none;" class="vista_previa_cv img img-fluid rounded-circle" width="250" alt="">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">


                        <!-- INGRESE EL TIPO DE PAGO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_pago" class="form-label">Ingrese el tipo de pago</label>
                                <select id="tipo_pago_t" class="form-select">
                                    <option value="" selected disabled>Seleccione</option>
                                    <option value="efectivo">Efectivo</option>
                                    <option value="targetaDebito">Targeta de débito</option>
                                    <option value="targetaCredito">Targeta de crédito</option>
                                </select>
                            </div>
                        </div>

                        <!-- INGRESE EL NUMERO DE CUENTA -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="num-cuenta" class="form-label">Número de cuenta</label>
                                <input type="text" id="numero_cuenta" class="form-control" placeholder="Ingrese el numero de cuenta">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- BOTONES PARA GUARDAR Y CERRAR -->
                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_guardar_trabajador" class="btn btn-primary mx-2">Guardar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>



<!-- ========================================
MODAL EDITAR TRABAJADOR
======================================== -->
<div class="modal fade" id="modalEditarTrabajador" tabindex="-1" aria-labelledby="modalEditarTrabajadorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar trabajador</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form enctype="multipart/form-data" id="form_actualizar_trabajador">

                <div class="modal-body">

                    <!-- ID DEL TRABAJADOR -->
                    <input type="hidden" id="edit_id_trabajador">

                    <!-- INGRESO DE NOMBRE -->
                    <div class="form-group">
                        <label>Ingrese el nombre completo (<span class="text-danger">*</span>)</label>
                        <input type="text" id="edit_nombre_t" placeholder="Ingrese el nombre completo">
                        <small id="edit_error_nombre_t"></small>
                    </div>

                    <div class="row">

                        <!-- INGRESO DE NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_numero_documento_t" placeholder="Ingrese el número de documento" minlength="8" required>
                                <small id="edit_error_numero_documento_t"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese teléfono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_telefono_t" placeholder="Ingrese el teléfono">
                                <small id="edit_error_telefono_t"></small>
                            </div>

                        </div>
                    </div>


                    <!-- INGRESO DE CORREO -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Ingrese el correo electrónico(<span class="text-danger">*</span>)</label>
                        <input type="email" id="edit_correo_t" class="form-control" placeholder="Ingrese el correo electrónico">
                        <small id="edit_error_correo_t"></small>
                    </div>


                    <div class="row">

                        <!-- INGRESO DE FOTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_trabajador" class="form-label">Ingrese la foto</label>
                                <input type="file" class="form-control" id="edit_foto_t" class="form-control foto_t" accept="image/*">
                                <div class="text-center mt-3">
                                    <img src="" class="edit_vista_previa_foto_trabajador img img-fluid rounded-circle" width="150" height="200"  alt="">
                                </div>
                                <input type="hidden" id="foto_actual_t">
                            </div>
                        </div>

                        <!-- INGRESO DE CV PDF -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cv_trabajador" class="form-label">Ingrese el CV</label>
                                <input type="file" class="form-control" id="edit_cv_t" accept="application/pdf">
                                <div class="text-center mt-3">
                                    <img src="vistas/pdf/pdf.png" style="display: none;" class="edit_vista_previa_cv img img-fluid rounded-circle" width="150" alt="">
                                </div>
                                <input type="hidden" id="cv_actual_t">
                            </div>
                        </div>

                    </div>

                    <div class="row">


                        <!-- INGRESE EL TIPO DE PAGO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_pago" class="form-label">Ingrese el tipo de pago</label>
                                <select id="edit_tipo_pago_t" class="form-select">
                                    <option value="" selected disabled>Seleccione</option>
                                    <option value="efectivo">Efectivo</option>
                                    <option value="targetaDebito">Targeta de débito</option>
                                    <option value="targetaCredito">Targeta de crédito</option>
                                </select>
                            </div>
                        </div>

                        <!-- INGRESE EL NUMERO DE CUENTA -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="num-cuenta" class="form-label">Número de cuenta</label>
                                <input type="text" id="edit_numero_cuenta" class="form-control" placeholder="Ingrese el numero de cuenta">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- BOTONES PARA GUARDAR Y CERRAR -->
                <div class="text-end mx-4 mb-2">

                    <button type="button" id="btn_actualizar_trabajador" class="btn btn-primary mx-2"><i class="fas fa-sync-alt"></i> Actualizar</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>

            </form>
        </div>
    </div>
</div>



<!-- ========================================
MODAL VER DETALLES DEL TRABAJADOR
======================================== -->
<div class="modal fade" id="modalVerTrabajador" tabindex="-1" aria-labelledby="modalVerTrabajadorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del trabajador</h5>
                <button type="button" class="close btn_modal_ver_close_usuario" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form enctype="multipart/form-data" id="form_ver_trabajador">
                <div class="modal-body">


                    <div class="row">

                        <!-- MOSTRANDO NOMBRE DEL TRABAJADOR -->
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-user text-primary"></i> Nombre del trabajador:</label>
                            <p id="mostrar_nombre_trabajador"></p>
                        </div>

                        <!-- MOSTRANDO NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label"><i class="fas fa-address-card text-success"></i> Número de documento:</label>
                                <p id="mostrar_numero_documento_trabajador"></p>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <!-- MOSTRAR EL CORREO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label"><i class="fas fa-phone text-warning"></i> Teléfono:</label>
                                <p id="mostrar_telefono_trabajador"></p>
                            </div>
                        </div>

                        <!-- MOSTRAR TELEFONO  -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label"><i class="fas fa-envelope text-info"></i> Correo:</label>
                                <P id="mostrar_correo_trabajador"></P>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <!-- MOSTRAR CORREO USUARIO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo" class="form-label"><i class="fas fa-image text-primary"></i> Foto:</label>
                                <img src="" class="mostrar_foto_trabajador img-fluid rounded-5 " alt="" width="100">
                            </div>
                        </div>

                        <!-- MOSTRAR USUARIO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario" class="form-label"><i class="fas fa-file-pdf text-danger"></i> CV:</label>
                                <a href="" class="descargar_cv_trabajador" download>
                                    <img src="" class="mostrar_cv_trabajador" alt="" width="120">
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <!-- MOSTRAR TIPO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo" class="form-label"><i class="fas fa-money-bill text-primary"></i> Tipo de pago:</label>
                                <P id="mostrar_tipo_pago_trabajador"></P>
                            </div>
                        </div>

                        <!-- MOSTRAR NUMERO DE CUENTA -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario" class="form-label"><i class="fas fa-credit-card text-danger"></i> Número de cuenta bancaria:</label>
                                <P id="mostrar_numero_cuenta_trabajador"></P>
                            </div>
                        </div>
                    </div>


                  


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" class="btn btn-secondary btn_modal_ver_close_usuario" data-bs-dismiss="modal"> Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>
