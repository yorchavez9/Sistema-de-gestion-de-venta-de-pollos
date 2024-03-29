<?php

class ControladorPermisoUsuario
{



	/*=============================================
	REGISTRO DE PERMSISO USUARIO
	=============================================*/

	static public function ctrCrearPermisoUsuario()
	{



		if(isset($_POST["id_usuario"])) {


            $tabla = "roles_usuario";

            $id_usuario = $_POST["id_usuario"];

            $permisos = $_POST["permisos"];
            $permisos_array = explode(",", $permisos);
            
            foreach ($permisos_array as $id_rol) {

                $datos = array(
                    "id_usuario" => $id_usuario,
                    "id_rol" => $id_rol
                );

                $respuesta = ModeloUsuarioPermiso::mdlIngresarUsuarioPermiso($tabla, $datos);

                if ($respuesta != "ok") {

                    echo json_encode("error");

                    return;
                }
            }

            echo json_encode("ok");

        } else {

            echo json_encode("error al obtener los datos");

        }
	}

	/*=============================================
	MOSTRAR PERMISO USUARIO
	=============================================*/

	static public function ctrMostrarPermisoUsuario($item, $valor)
	{

		$tablaUsuario = "usuarios";
		$tablaRol = "roles";
		$tablaPermiso = "roles_usuario";

		$respuesta = ModeloUsuarioPermiso::mdlMostrarUsuarioPermiso($tablaUsuario, $tablaRol, $tablaPermiso, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR PERMISO USUARIO
	=============================================*/

	static public function ctrEditarPermisoUsuario()
	{
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["edit_nombre_rol"])) {

			$tabla = "roles";

			$datos = array(
				"id_rol" => $_POST["edit_id_rol"],
				"nombre_rol" => $_POST["edit_nombre_rol"]
			);

			$respuesta = ModeloUsuarioPermiso::mdlEditarUsuarioPermiso($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}

		} else {

			echo json_encode("ok");
		}
	}

	/*=============================================
	BORRAR PERMISO USUARIO
	=============================================*/

	static public function ctrBorraPermisoUsuario()
	{

		if (isset($_POST["deleteIdRol"])) {

			$tabla = "roles";

			$datos = $_POST["deleteIdRol"];

			$respuesta = ModeloUsuarioPermiso::mdlBorrarUsuarioPermiso($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}
