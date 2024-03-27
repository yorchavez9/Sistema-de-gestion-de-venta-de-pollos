<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de clientes</h4>
                <h6>Administrar clientes</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoCliente"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar cliente</a>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_clientes">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Dirección</th>
                                <th>telefono</th>
                                <th>Correo</th>
                                <th>estado</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="dataClientes">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL NUEVO CLIENTE -->
<div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-labelledby="modalNuevoClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo cliente</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_cliente">

                <div class="modal-body">

                    <!-- INGRESO TIPO DE PERSONA -->
                    <div class="form-group">
                        <input type="hidden" id="tipo_personas_c" value="cliente">
                    </div>

                    <!-- INGRESO NOMBRE -->
                    <div class="form-group">
                        <label class="form-label">Ingrese el nombre (<span class="text-danger">*</span>)</label>
                        <input type="text" id="razon_social_c" placeholder="Ingrese el nombre completo">
                        <small id="error_razon_social_c"></small>
                    </div>


                    <div class="row">

                        <!-- INGRESO DE TIPO DE DOCUMENTOS -->
                        <div class="col-md-6">
                            <label class="form-label">Selecione el tipo de documento (<span class="text-danger">*</span>)</label>
                            <?php
                            $item = null;
                            $valor = null;
                            $tiposDocumentos = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);
                            ?>
                            <select class="select" id="id_doc_c">
                                <option disabled selected>Seleccione</option>
                                <?php
                                foreach ($tiposDocumentos as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id_doc"] ?>"><?php echo $value["nombre_doc"] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <small id="error_id_doc_c"></small>
                        </div>

                        <!-- INGRESO DE NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="numero_documento_c" placeholder="Ingrese el número de documento">
                                <small id="error_numero_documento_c"></small>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <!-- INGRESE LA DIRECCIÓN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese la dirección </label>
                                <input type="text" id="direccion_c" placeholder="Ingrese la dirección">
                            </div>
                        </div>

                        <!-- INGRESE LA CIUDAD -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese la ciudad (<span class="text-danger">*</span>)</label>
                                <input type="text" id="ciudad_c" placeholder="Ingrese la ciudad">
                                <small id="error_ciudad_c"></small>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <!-- INGRESO DE CODIGO POSTAL -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo_postal" class="form-label">Ingrese el codigo postal</label>
                                <input type="text" id="codigo_postal_c" placeholder="Ingrese el código postal">
                                <small id="error_codigo_postal_c"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese el telefono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="telefono_c" placeholder="Ingrese el teléfono">
                                <small id="error_telefono_c"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DEL CORREO ELECTRÓNICO -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Ingrese el correo electrónico (<span class="text-danger">*</span>)</label>
                        <div class="pass-group">
                            <input type="text" id="correo_c" placeholder="Ingrese el correo electrónico">
                            <small id="error_correo_c"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sitio_web" class="form-label">Ingrese el sitio web</label>
                        <input type="text" id="sitio_web_c" placeholder="Ingrese el link del sitio web">
                        <small id="error_sitio_web_c"></small>
                    </div>

                    <div class="row">

                        <!-- INGRESO TIPO DE BANCO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_banco" class="form-label">Selecione el tipo de banco</label>
                                <select class="select" id="tipo_banco_c">
                                    <option disabled selected>Selecione</option>
                                    <option value="BCRP">Banco Central de Reserva del Perú</option>
                                    <option value="BCP">Banco de Crédito del Perú (BCP)</option>
                                    <option value="SBP">Scotiabank Perú</option>
                                    <option value="IB">Interbank</option>
                                    <option value="BBVA">BBVA Perú</option>
                                    <option value="BR">Banco Rural</option>
                                    <option value="BN">Banco de la Nación</option>
                                    <option value="BF">Banco Falabella</option>
                                </select>
                                <small id="error_tipo_banco_c"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_cuenta" class="form-label">Ingrese la cuenta bancaria</label>
                                <input type="text" id="numero_cuenta_c" placeholder="Ingrese el numero de cuenta bancaria">
                                <small id="error_numero_cuenta_c"></small>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_guardar_cliente" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL VER CLIENTE -->
<div class="modal fade" id="modalVerCliente" tabindex="-1" aria-labelledby="modalVerClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary"><i class="fas fa-info-circle"></i> Detalles del Proveedor</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data">
                <div class="modal-body">
                    <fieldset>

                        <div class="mb-3">
                            <label class="form-label fs-6"><i class="fas fa-building text-danger"></i> Razón social:</label>
                            <p id="ver_razon_social_p" class="text-muted fs-6"></p>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fs-6"><i class="far fa-id-card text-success"></i> Tipo de documento:</label>
                                <p id="ver_tipo_documento_p" class="text-muted fs-6"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-6"><i class="fas fa-id-card text-warning"></i> Número de documento:</label>
                                <p id="ver_numero_documento_p" class="text-muted fs-6"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fs-6"><i class="fas fa-map-marker-alt text-info"></i> Dirección:</label>
                                <p id="ver_direccion_p" class="text-muted fs-6"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-6"><i class="fas fa-city text-primary"></i> Ciudad:</label>
                                <p id="ver_ciudad_p" class="text-muted fs-6"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fs-6"><i class="fas fa-envelope text-danger"></i> Correo electrónico:</label>
                                <p id="ver_correo_p" class="text-muted fs-6"></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-6"><i class="fas fa-phone text-success"></i> Teléfono:</label>
                                <p id="ver_telefono_p" class="text-muted fs-6"></p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fs-6"><i class="fas fa-globe text-warning"></i> Sitio web:</label>
                            <a href="#" id="ver_sitio_web_p" class="text-decoration-none text-muted fs-6"></a>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fs-6"><i class="fas fa-university text-info"></i> Tipo de banco:</label>

                                <div class="form-group">
                                    <select class="form-select form-select-sm text-muted fs-6" id="ver_tipo_banco_p">
                                        <option value="BCRP">Banco Central de Reserva del Perú</option>
                                        <option value="BCP">Banco de Crédito del Perú (BCP)</option>
                                        <option value="SBP">Scotiabank Perú</option>
                                        <option value="IB">Interbank</option>
                                        <option value="BBVA">BBVA Perú</option>
                                        <option value="BR">Banco Rural</option>
                                        <option value="BN">Banco de la Nación</option>
                                        <option value="BF">Banco Falabella</option>
                                    </select>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-6"><i class="fas fa-credit-card text-primary"></i> Cuenta bancaria:</label>
                                <p id="ver_numero_cuenta_p" class="text-muted fs-6"></p>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- MODAL EDITAR CLIENTE -->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="modalEditarClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_edit_cliente">
                <div class="modal-body">

                    <!-- ID PROVEEDOR -->
                    <input type="hidden" id="edit_id_c">

                    <!-- INGRESO DE RAZÓN SOCIAL -->
                    <div class="form-group">
                        <label class="form-label">Ingrese la razón social (<span class="text-danger">*</span>)</label>
                        <input type="text" id="edit_razon_social_c" placeholder="Ingrese la razon social">
                        <small id="edit_error_rz_c"></small>
                    </div>


                    <div class="row">

                        <!-- INGRESO DE TIPO DE DOCUMENTOS -->
                        <div class="col-md-6">
                            <label class="form-label">Selecione el tipo de documento (<span class="text-danger">*</span>)</label>
                            <?php
                            $item = null;
                            $valor = null;
                            $tiposDocumentos = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);
                            ?>
                            <select class="form-select form-select-sm" id="edit_id_doc_c">

                                <?php
                                foreach ($tiposDocumentos as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id_doc"] ?>"><?php echo $value["nombre_doc"] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <small id="edit_error_id_doc_c"></small>
                        </div>

                        <!-- INGRESO DE NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_numero_documento_c" placeholder="Ingrese el número de documento">
                                <small id="edit_error_nd_c"></small>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <!-- INGRESE LA DIRECCIÓN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese la dirección </label>
                                <input type="text" id="edit_direccion_c" placeholder="Ingrese la dirección">
                            </div>
                        </div>

                        <!-- INGRESE LA CIUDAD -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese la ciudad (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_ciudad_c" placeholder="Ingrese la ciudad">
                                <small id="edit_error_c_c"></small>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <!-- INGRESO DE CODIGO POSTAL -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo_postal" class="form-label">Ingrese el codigo postal</label>
                                <input type="text" id="edit_codigo_postal_c" placeholder="Ingrese el código postal">
                                <small id="edit_error_cp_c"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese el telefono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_telefono_c" placeholder="Ingrese el teléfono">
                                <small id="edit_error_t_c"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DEL CORREO ELECTRÓNICO -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Ingrese el correo electrónico (<span class="text-danger">*</span>)</label>
                        <div class="pass-group">
                            <input type="text" id="edit_correo_c" placeholder="Ingrese el correo electrónico">
                            <small id="edit_error_c_c"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sitio_web" class="form-label">Ingrese el sitio web</label>
                        <input type="text" id="edit_sitio_web_c" placeholder="Ingrese el link del sitio web">
                        <small id="edit_error_sitio_web_c"></small>
                    </div>

                    <div class="row">

                        <!-- INGRESO TIPO DE BANCO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_banco" class="form-label">Selecione el tipo de banco</label>
                                <select class="form-select form-select-sm" id="edit_tipo_banco_c">
                                    <option value="BCRP">Banco Central de Reserva del Perú</option>
                                    <option value="BCP">Banco de Crédito del Perú (BCP)</option>
                                    <option value="SBP">Scotiabank Perú</option>
                                    <option value="IB">Interbank</option>
                                    <option value="BBVA">BBVA Perú</option>
                                    <option value="BR">Banco Rural</option>
                                    <option value="BN">Banco de la Nación</option>
                                    <option value="BF">Banco Falabella</option>
                                </select>
                                <small id="edit_error_tipo_banco_c"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_cuenta" class="form-label">Ingrese la cuenta bancaria</label>
                                <input type="text" id="edit_numero_cuenta_c" placeholder="Ingrese el numero de cuenta bancaria">
                                <small id="edit_error_numero_bancaria_c"></small>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_actualizar_cliente" class="btn btn-primary mx-2"><i class="fas fa-sync"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

