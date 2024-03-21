<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="login-userset">
                    <div class="login-logo text-center ">
                        <img src="vistas/dist/assets/img/logo.png" class="text-center" alt="img">
                    </div>
                    <div class="login-userheading text-center ">
                        <h3>Iniciar sesión</h3>
                        <h4>Por favor, ingrese a su cuenta</h4>
                    </div>


                    <form id="login_form" method="POST">

                        <!-- INGRESO DE CORREO O CONTRASEÑA -->

                        <div class="form-login">
                            <label>Ingrese su correo o usuario</label>
                            <div class="form-addons">
                                <input type="text" id="ingUsuario" name="ingUsuario" placeholder="Ingrese su correo o usuario">
                                <img src="vistas/dist/assets/img/icons/mail.svg" alt="img">
                            </div>
                            <div id="errorIngUsuario"></div>
                        </div>

                        <!-- INGRESO DE CONTRASEÑA -->

                        <div class="form-login">
                            <label>Ingrese su contraseña</label>
                            <div class="pass-group">
                                <input type="password" id="ingPassword" name="ingPassword" class="pass-input" placeholder="Ingrese su contraseña">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                            <div id="errorIngPassword"></div>
                        </div>

                        <!-- RECORDAR CONTRASEÑA -->

                        <div class="form-login">
                            <div class="alreadyuser">
                                <h4><a href="forgetpassword.html" class="hover-a">¿Has olvidado tu contraseña?</a></h4>
                            </div>
                        </div>


                        <!-- BOTON PARA INGRESAR -->

                        <div class="form-login">
                            <button type="submit" id="button_submit_login" class="btn btn-login rounded-3">Iniciar sesión</button>
                        </div>

                        <?php
                        $ingresousuario = new ControladorUsuarios();
                        $ingresousuario->ctrIngresoUsuario();
                        ?>

                    </form>



                    <div class="signinform text-center">
                        <h4>¿No tienes una cuenta? <a href="signup.html" class="hover-a">Inscribirse</a></h4>
                    </div>
                    <div class="form-setlogin">
                        <h4>O regístrate con</h4>
                    </div>
                    <div class="form-sociallink">
                        <ul>
                            <li>
                                <a href="javascript:void(0);">
                                    <img src="vistas/dist/assets/img/icons/google.png" class="me-2" alt="google">
                                    Regístrate usando Google
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <img src="vistas/dist/assets/img/icons/facebook.png" class="me-2" alt="google">
                                    Regístrate usando Facebook
                                    
                                </a>
                        
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="login-img">
                <img src="vistas/dist/assets/img/login.jpg" alt="img">
            </div>
        </div>
    </div>
</div>