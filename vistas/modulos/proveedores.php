<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de proveedores</h4>
                <h6>Administrar proveedores</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoProveedor"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar proveedor</a>
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
                    <table class="table  datanew" id="tabla_proveedores">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Razon social</th>
                                <th>Documento</th>
                                <th>Dirección</th>
                                <th>telefono</th>
                                <th>Correo</th>
                                <th>estado</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="dataProveedores">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL NUEVO USUARIO -->
<div class="modal fade" id="modalNuevoProveedor" tabindex="-1" aria-labelledby="modalNuevoProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo proveedor</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="nuevoProveedor">
                <div class="modal-body">

                    <!-- INGRESO TIPO DE PROVEEDOR -->
                    <div class="form-group">
                        <input type="hidden" id="tipo_persona_proveedor" value="proveedor">
                    </div>

                    <!-- INGRESO DE RAZÓN SOCIAL -->
                    <div class="form-group">
                        <label class="form-label">Ingrese la razón social (<span class="text-danger">*</span>)</label>
                        <input type="text" id="razon_social_proveedor" placeholder="Ingrese la razon social">
                        <small id="validate_razon_social_proveedor"></small>
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
                            <select class="select" id="id_doc_proveedor">
                                <option disabled selected>Seleccione</option>
                                <?php
                                foreach ($tiposDocumentos as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id_doc"] ?>"><?php echo $value["nombre_doc"] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <small id="validate_tipo_documento_proveedor"></small>
                        </div>

                        <!-- INGRESO DE NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="numero_documento_proveedor" placeholder="Ingrese el número de documento">
                                <small id="validate_numero_documento_proveedor"></small>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <!-- INGRESE LA DIRECCIÓN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese la dirección </label>
                                <input type="text" id="direccion_proveedor" placeholder="Ingrese la dirección">
                            </div>
                        </div>

                        <!-- INGRESE LA CIUDAD -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese la ciudad (<span class="text-danger">*</span>)</label>
                                <input type="text" id="ciudad_proveedor" placeholder="Ingrese la ciudad">
                                <small id="validate_ciudad_proveedor"></small>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <!-- INGRESO DE CODIGO POSTAL -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo_postal" class="form-label">Ingrese el codigo postal</label>
                                <input type="text" id="codigo_postal_proveedor" placeholder="Ingrese el código postal">
                                <small id="validate_codigo_postal_proveedor"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese el telefono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="telefono_proveedor" placeholder="Ingrese el teléfono">
                                <small id="validate_telefono_proveedor"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DEL CORREO ELECTRÓNICO -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Ingrese el correo electrónico (<span class="text-danger">*</span>)</label>
                        <div class="pass-group">
                            <input type="text" id="correo_proveedor" placeholder="Ingrese el correo electrónico">
                            <small id="validate_correo_proveedor"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sitio_web" class="form-label">Ingrese el sitio web</label>
                        <input type="text" id="sitio_web_proveedor" placeholder="Ingrese el link del sitio web">
                        <small id="validate_sitio_web_proveedor"></small>
                    </div>

                    <div class="row">

                        <!-- INGRESO TIPO DE BANCO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_banco" class="form-label">Selecione el tipo de banco</label>
                                <select class="select" id="tipo_banco_proveedor">
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
                                <small id="tipo_banco_proveedor"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_cuenta" class="form-label">Ingrese la cuenta bancaria</label>
                                <input type="text" id="numero_cuenta_proveedor" placeholder="Ingrese el numero de cuenta bancaria">
                                <small id="validate_numero_bancaria_proveedor"></small>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="guardar_proveedor" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL VER USUARIO -->
<div class="modal fade" id="modalVerProveedor" tabindex="-1" aria-labelledby="modalVerProveedorLabel" aria-hidden="true">
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


<!-- MODAL EDITAR USUARIO -->
<div class="modal fade" id="modalEditarProveedor" tabindex="-1" aria-labelledby="modalEditarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar proveedor</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="formEditProveedor">
                <div class="modal-body">

                    <!-- ID PROVEEDOR -->
                    <input type="hidden" id="edit_id_proveedor">

                    <!-- INGRESO DE RAZÓN SOCIAL -->
                    <div class="form-group">
                        <label class="form-label">Ingrese la razón social (<span class="text-danger">*</span>)</label>
                        <input type="text" id="edit_razon_social_proveedor" placeholder="Ingrese la razon social">
                        <small id="edit_error_rz"></small>
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
                            <select class="form-select form-select-sm" id="edit_id_doc_proveedor">

                                <?php
                                foreach ($tiposDocumentos as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id_doc"] ?>"><?php echo $value["nombre_doc"] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <small id="edit_error_id_doc"></small>
                        </div>

                        <!-- INGRESO DE NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_numero_documento_proveedor" placeholder="Ingrese el número de documento">
                                <small id="edit_error_nd"></small>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <!-- INGRESE LA DIRECCIÓN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese la dirección </label>
                                <input type="text" id="edit_direccion_proveedor" placeholder="Ingrese la dirección">
                            </div>
                        </div>

                        <!-- INGRESE LA CIUDAD -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese la ciudad (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_ciudad_proveedor" placeholder="Ingrese la ciudad">
                                <small id="edit_error_c"></small>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <!-- INGRESO DE CODIGO POSTAL -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo_postal" class="form-label">Ingrese el codigo postal</label>
                                <input type="text" id="edit_codigo_postal_proveedor" placeholder="Ingrese el código postal">
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese el telefono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_telefono_proveedor" placeholder="Ingrese el teléfono">
                                <small id="edit_error_t"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DEL CORREO ELECTRÓNICO -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Ingrese el correo electrónico (<span class="text-danger">*</span>)</label>
                        <div class="pass-group">
                            <input type="text" id="edit_correo_proveedor" placeholder="Ingrese el correo electrónico">
                            <small id="edit_error_c"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sitio_web" class="form-label">Ingrese el sitio web</label>
                        <input type="text" id="edit_sitio_web_proveedor" placeholder="Ingrese el link del sitio web">
                        <small id="edit_validate_sitio_web_proveedor"></small>
                    </div>

                    <div class="row">

                        <!-- INGRESO TIPO DE BANCO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_banco" class="form-label">Selecione el tipo de banco</label>
                                <select class="form-select form-select-sm" id="edit_tipo_banco_proveedor">
                                    <option value="BCRP">Banco Central de Reserva del Perú</option>
                                    <option value="BCP">Banco de Crédito del Perú (BCP)</option>
                                    <option value="SBP">Scotiabank Perú</option>
                                    <option value="IB">Interbank</option>
                                    <option value="BBVA">BBVA Perú</option>
                                    <option value="BR">Banco Rural</option>
                                    <option value="BN">Banco de la Nación</option>
                                    <option value="BF">Banco Falabella</option>
                                </select>
                                <small id="edit_validate_tipo_banco_proveedor"></small>
                            </div>
                        </div>

                        <!-- INGRESO DE TELEFONO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_cuenta" class="form-label">Ingrese la cuenta bancaria</label>
                                <input type="text" id="edit_numero_cuenta_proveedor" placeholder="Ingrese el numero de cuenta bancaria">
                                <small id="edit_validate_numero_bancaria_proveedor"></small>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="actualizar_proveedor" class="btn btn-primary mx-2"><i class="fas fa-sync"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>