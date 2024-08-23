<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de usuarios</h4>
                <h6>Administrar usuarios</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoUsuario"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar usuario</a>
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


<!-- MODAL NUEVO USUARIO -->
<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="modalNuevoUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear nuevo usuario</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form enctype="multipart/form-data" id="nuevoUsuario">
                
                <div class="modal-body">

                    <!-- INGRESO DE NOMBRE -->
                    <div class="form-group">
                        <label>Ingrese el nombre completo (<span class="text-danger">*</span>)</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Ingrese el nombre completo">
                        <small id="errorNombreUsuario"></small>
                    </div>

                    <!-- INGRESO DE TIPO DE DOCUMENTO Y NUMERO DOCUMENTO -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Selecione el tipo de documento (<span class="text-danger">*</span>)</label>
                            <?php

                            $item = null;

                            $valor = null;

                            $tiposDocumentos = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);

                            ?>
                            <select class="select" id="id_doc">
                                <option disabled selected>Seleccione</option>
                                <?php
                                foreach ($tiposDocumentos as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id_doc"] ?>"><?php echo $value["nombre_doc"] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <small id="errorTipoDocumento"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="numero_documento" placeholder="Ingrese el número de documento">
                                <small id="errorNumeroDocumento"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DE DIRECCION Y TELEFONO -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese la dirección </label>
                                <input type="text" id="direccion" placeholder="Ingrese la dirección">
                                <small id="errorDireccionUsuario"></small>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese teléfono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="telefono" placeholder="Ingrese el teléfono">
                                <small id="errorTelefonoUsuario"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DE CORREO ELECTRONICO Y USUARIO-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo" class="form-label">Ingrese el correo electrónico(<span class="text-danger">*</span>)</label>
                                <input type="email" id="correo" class="form-control" placeholder="Ingrese el correo electrónico">
                                <small id="errorCorreoUsuario"></small>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario" class="form-label">Ingrese el usuario (<span class="text-danger">*</span>)</label>
                                <input type="text" id="usuario" placeholder="Ingrese el usuario">
                                <small id="errorUsuario"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DE CONTRASEÑA -->
                    <div class="form-group">
                        <label for="contrasena" class="form-label">Ingrese la contraseña (<span class="text-danger">*</span>)</label>

                        <div class="pass-group">
                            <input type="password" id="contrasena" name="contrasena" class="pass-input" placeholder="Ingrese la contraseña">
                            <span class="fas toggle-password fa-eye-slash"></span>
                            <small id="errorContrasena"></small>
                        </div>


                    </div>

                    <!-- INGRESO DE IMAGEN DEL USUARIO -->
                    <div class="form-group">
                        <label for="imagen_usuario" class="form-label"></label>
                        <input type="file" class="form-control" id="imagen_usuario" class="">
                        <div class="text-center mt-3">
                            <img src="" class="vistaPreviaImagenUsuario img img-fluid rounded-circle" width="250" alt="">
                            <small id="errorImagenUsuario"></small>
                        </div>
                    </div>

                    <!-- ROLES -->

                    <div class="form-group">
                        <h5 class="fw-bold mb-2">Roles</h5>
                        <div id="data_roles">
                            <input type="checkbox" class="data_rol mx-2 " id="rol_administrador" value="administrador"><small>Administrador</small>
                            <input type="checkbox" class="data_rol mx-2 " id="rol_cajero" value="cajero"><small>Cajero</small>
                            <input type="checkbox" class="data_rol mx-2 " id="rol_ayudante" value="ayudante"><small>Ayudante</small>
                            <!-- <input type="checkbox" class="data_rol mx-2 " id="rol_prueba" value="prueba"><small>Prueba</small> -->
                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="guardar_usuario" class="btn btn-primary mx-2">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR   USUARIO -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar usuario</h5>
                <button type="button" class="btn_modal_editar_close_usuario close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="formEditUsuario">
                <div class="modal-body">

                    <!-- ID -->
                    <input type="hidden" id="editIdUsuario">

                    <!-- INGRESO DE NOMBRE -->
                    <div class="form-group">
                        <label>Ingrese el nombre completo (<span class="text-danger">*</span>)</label>
                        <input type="text" id="edit_nombre_usuario">
                        <small id="editerrorNombreUsuario"></small>
                    </div>

                    <!-- INGRESO DE TIPO DE DOCUMENTO Y NUMERO DOCUMENTO -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Selecione el tipo de documento (<span class="text-danger">*</span>)</label>
                            <?php
                            $item = null;
                            $valor = null;
                            $tiposDocumentos = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);
                            ?>
                            <select class="select" id="edit_id_doc">
                                <?php
                                foreach ($tiposDocumentos as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id_doc"] ?>"><?php echo $value["nombre_doc"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <small id="editerrorTipoDocumento"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label">Ingrese el número de documento (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_numero_documento" placeholder="Ingrese el número de documento">
                                <small id="errorNumeroDocumento"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DE DIRECCION Y TELEFONO -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Ingrese la dirección </label>
                                <input type="text" id="edit_direccion" placeholder="Ingrese la dirección">
                                <small id="editerrorDireccionUsuario"></small>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Ingrese teléfono (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_telefono" placeholder="Ingrese el teléfono">
                                <small id="editerrorTelefonoUsuario"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DE CORREO ELECTRONICO Y USUARIO-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo" class="form-label">Ingrese el correo electrónico(<span class="text-danger">*</span>)</label>
                                <input type="email" id="edit_correo" class="form-control" placeholder="Ingrese el correo electrónico">
                                <small id="editerrorCorreoUsuario"></small>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario" class="form-label">Ingrese el usuario (<span class="text-danger">*</span>)</label>
                                <input type="text" id="edit_usuario" placeholder="Ingrese el usuario">
                                <small id="editerrorUsuario"></small>
                            </div>

                        </div>
                    </div>

                    <!-- INGRESO DE CONTRASEÑA -->
                    <div class="form-group">
                        <label for="contrasena" class="form-label">Ingrese la contraseña (<span class="text-danger">*</span>)</label>

                        <div class="pass-group">
                            <input type="password" id="edit_contrasena" name="contrasena" class="pass-input" placeholder="Ingrese la contraseña">
                            <span class="fas toggle-password fa-eye-slash"></span>

                        </div>
                        <input type="hidden" id="passwordActual">


                    </div>

                    <div class="form-group">
                        <label for="imagen_usuario" class="form-label"></label>
                        <input type="file" class="form-control" id="edit_imagen_usuario" class="">
                        <div class="text-center mt-3">
                            <img src="" class="editVistaPreviaImagenUsuario img img-fluid rounded-circle" width="250" alt="">
                        </div>
                        <input type="hidden" id="imagenActualUsuario">
                    </div>

                    <!-- ROLES -->

                    <div class="form-group">
                        <h5 class="fw-bold mb-2">Editar roles</h5>
                        <div id="edit_data_roles">
                            <input type="checkbox" class="edit_data_rol mx-2 " id="edit_rol_administrador" value="administrador"><small>Administrador</small>
                            <input type="checkbox" class="edit_data_rol mx-2 " id="edit_rol_cajero" value="cajero"><small>Cajero</small>
                            <input type="checkbox" class="edit_data_rol mx-2 " id="edit_rol_ayudante" value="ayudante"><small>Ayudante</small>
                        </div>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="actualizar_usuario" class="btn btn-primary mx-2">Actualizar</button>
                    <button type="button" class="btn_modal_editar_close_usuario btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL VER   USUARIO -->
<div class="modal fade" id="modalVerUsuario" tabindex="-1" aria-labelledby="modalVerUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del usuario</h5>
                <button type="button" class="close btn_modal_ver_close_usuario" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="formVerUsuario">
                <div class="modal-body">

                    <!-- MOSTRANDO NOMBRE DEL USUARIO -->
                    <div class="form-group">
                        <label><i class="fas fa-user text-primary"></i> Nombre de usuario:</label>
                        <p id="mostrar_nombre_usuario"></p>
                    </div>

                    <div class="row">

                        <!-- MOSTRANDO TIPO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-id-card-alt text-danger"></i> Tipo de documento:</label>
                            <p id="mostrar_tipo_documento"></p>
                        </div>

                        <!-- MOSTRANDO NUMERO DE DOCUMENTO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento" class="form-label"><i class="fas fa-address-card text-success"></i> Número de documento:</label>
                                <p id="mostrar_numero_documento_usuario"></p>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <!-- MOSTRAR LA DIRECCION DEL USUARIO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion" class="form-label"><i class="fas fa-map-marker-alt text-warning"></i> Dirección:</label>
                                <p id="mostrar_direccion_usuario"></p>
                            </div>
                        </div>

                        <!-- MOSTRAR TELEFONO DE USUARIO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="form-label"><i class="fas fa-phone text-info"></i> Teléfono:</label>
                                <P id="mostrar_telefono_usuario"></P>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <!-- MOSTRAR CORREO USUARIO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo" class="form-label"><i class="fas fa-envelope text-primary"></i> Correo:</label>
                                <p id="mostrar_correo_usuario"></p>
                            </div>
                        </div>

                        <!-- MOSTRAR USUARIO -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario" class="form-label"><i class="fas fa-user-circle text-danger"></i> Usuario:</label>
                                <P id="mostrar_usuario"></P>
                            </div>
                        </div>
                    </div>


                    <!-- MOSTRAR IMAGEN DEL USUARIO -->
                    <div class="form-group">
                        <label for="imagen_usuario" class="form-label"><i class="fas fa-image text-success"></i> FOTO:</label>
                        <div class="text-center mt-3">
                            <img src="" class="mostrarFotoUsuario img img-fluid rounded-circle" width="250" alt="">
                        </div>
                    </div>


                    <!-- ROLES -->
                    <div class="form-group">
                        <h5 class="fw-bold mb-2"><i class="fas fa-users text-warning"></i> Roles:</h5>
                        <div id="mostrar_roles">
                            <!-- Aquí puedes mostrar los roles -->
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
