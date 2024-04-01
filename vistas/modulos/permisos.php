<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Lista de permisos de usuario</h4>
                <h6>Administrar permisos</h6>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#modalNuevoPermisoUsuario"><img src="vistas/dist/assets/img/icons/plus.svg" alt="img" class="me-2">Agregar permiso</a>
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
                    <table class="table table-striped table-bordered" style="width:100%" id="tabla_permiso">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Usuario</th>
                                <th>Permisos</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="data_permisos">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL NUEVO PERMISO -->
<div class="modal fade" id="modalNuevoPermisoUsuario" tabindex="-1" aria-labelledby="modalNuevoPermisoUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear permiso del usuario</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_nuevo_permisos">
                <div class="modal-body">

                    <!-- INGRESO TIPO DE PROVEEDOR -->
                    <div class="form-group">
                        <label for="nombre_rol" class="form-label">Selecion el usuario (<span class="text-danger">*</span>)</label>
                        <select class="form-select form-select-sm"  id="id_usuario_permiso">
                            <option selected disabled>Selecion el usuario</option>
                            <?php 
                            $item = null;
                            $valor = null;
                            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                            foreach ($usuarios as $key => $usuario) {
                            ?>
                            <option value="<?php echo $usuario["id_usuario"]?>"><?php echo $usuario["nombre_usuario"]?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <small id="error_id_usuario_permiso"></small>
                    </div>

                    <hr>
                    <div class="form-group" id="section_permisos">
                        <h5 class="fw-bold mb-2">Permisos</h5>
                        <?php
                        $item = null;
                        $valor = null;
                        $roles = ControladorRoles::ctrMostrarRol($item, $valor);
                        foreach ($roles as $key => $rol) {
                        ?>
                        <div class="mb-1">
                            <input type="checkbox" value="<?php echo $rol["id_rol"]?>" class="valor_rol"> <span><?php echo $rol["nombre_rol"]?></span>
                        </div>
                        <?php
                        }
                        ?>
                        <small id="error_id_rol_permiso"></small>
                    </div>


                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_guardar_permiso" class="btn btn-primary mx-2"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR PERMISO -->
<div class="modal fade" id="modalEditarUsuarioPermiso" tabindex="-1" aria-labelledby="modalEditarPermisoUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Rol</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form enctype="multipart/form-data" id="form_actualizar_rol">
                <div class="modal-body">

                    <!-- ID ROL -->
                    <input type="text" name="edit_id_permiso" id="edit_id_permiso">

                    <!-- INGRESO NOMBRE -->
                    <div class="form-group">
                        <label for="nombre_categoria" class="form-label">Ingrese el nombre (<span class="text-danger">*</span>)</label>
                        <input type="text" name="edit_nombre_rol" id="edit_nombre_rol" placeholder="Ingresa el nombre">
                        <small id="edit_error_nombre_rol"></small>
                    </div>

                </div>

                <div class="text-end mx-4 mb-2">
                    <button type="button" id="btn_actualizar_rol" class="btn btn-primary mx-2"><i class="fas fa-sync"></i> Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>



