<?php 
    if(isset($_SESSION["validarSession"])){
        if($_SESSION["validarSession"] == "ok"){
            header("location: ".URL."home");
            return;
        }
    }
    $csrf = Seguridad::CrearToken("login");
?>
<link rel="stylesheet" href="<?php echo CSS."login.css" ?>">

<title>Bienvenidos a UDALV</title>
<main class="main-menu">
    <div class="ctn-menu">
        <div class="information-menu" id="information-menu">
            <h1>Planea más facíl, planea más rápido</h1>
            <div class="animation">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player src="<?php echo IMG."lf30_editor_nnvF60.json" ?>"  speed="1" loop  autoplay></lottie-player>
            </div>
            <div class="ctn-btn">
                <a href="#" onclick="RegistrarUser()" class="btn-registrar2">Registrate</a>
                <a href="#" onclick="Userlogin()" class="btn-iniciar2">Iniciar sesión</a>
            </div>
        </div>
        <div class="ctn-form-login" id="ctn-form-login">
            <div class="options">
                <button class="button-options active-options" onclick="Userlogin()" id="btnIniciar">Iniciar Sesión</button>
                <button class="button-options" onclick="RegistrarUser()" id="btnRegistrar">Registrarse</button>
            </div>
            <h2>Bienvenido a UDALV</h2>
            <form action="" id="form-login" class="form-login" method="POST">
                <div class="form-group">
                    <input type="email" name="ingresarEmail" id="ingresarEmail" ><span class="barra"></span>
                    <label for="">Correo Electónico</label>
                    <p class="warning-error">El correo no es válido o está vacío</p>
                </div>
                <div class="form-group">
                    <input type="password" name="ingresarPwd" id="ingresarPwd" ><span class="barra"></span>
                    <label for="">Contraseña</label>
                    <p class="warning-error">La contraseña no es válida, debe contener entre 4 y 20 caracteres y no debe contener caracteres especiales</p>
                </div>
                <input type="submit" value="Iniciar Sesión" class="btn-iniciar">
                <!-- <a href="#" class="forgot-pwd">¿Olvidaste tu contraseña?</a> -->
                <div class="forgot-pwd">
                    <span>¿Aún no te has registrado?</span>
                    <a href="#" onclick="RegistrarUser()">Crear cuenta</a>
                </div>
                <input type="hidden" name="tokenCSRF" value="<?php echo $csrf ?>">
                <?php 
                    $iniciarSession = new ControladorUsuario();
                    $iniciarSession->ctrIniciarSession();
                ?>
            </form>
            <form action="" method="post" id="form-register" class="form-register">
                <div class="form-group">
                    <input type="text" name="registrarNombre" required id="registrarNombre"><span class="barra"></span>
                    <label for="">Nombre y Apellido</label>
                    <p class="warning-error">El nombre solo puede contener letras</p>
                </div>
                <div class="form-group">
                    <input type="email" name="registrarCorreo" id="registrarCorreo" required><span class="barra"></span>
                    <label for="">Correo Electrónico</label>
                    <p class="warning-error">El correo solo puede contener letras, números, puntos, guiones y guión bajo</p>
                </div>
                <div class="form-group">
                    <input type="password" name="registrarPwd" id="registrarPwd" required><span class="barra"></span>
                    <label for="">Contraseña</label>
                    <p class="warning-error">La contraseña tiene que ser de 4 a 12 dígitos</p>
                </div>
                <div class="form-group">
                    <input type="password" name="confirmPws" id="confirmPws" required><span class="barra"></span>
                    <label for="">Confirmar contraseña</label>
                    <p class="warning-error">Las contraseñas no coinciden</p>
                </div>
                <div class="terms">
                    <label>
                        <input type="checkbox" name="termsAndConditions" id="termsAndConditions" required>
                        <span>Acepto los terminos y condiciones del servicio</span>
                    </label>
                </div>
                <input type="submit" value="Registrarme" class="btn-registrar">

                <div class="have-accont">
                    <span>¿Ya tienes una cuenta?</span>
                    <a href="#" onclick="Userlogin()">Iniciar sesión</a>
                </div>
                <input type="hidden" name="tokenCSRF" value="<?php echo $csrf ?>">
                <?php 
                    $registrarUsuario = new ControladorUsuario();
                    $registrarUsuario->ctrRegistrarUsuario();
                ?>
            </form>
        </div>
    </div>
</main>
<script src="<?php echo JS."login.js" ?>"></script>
<script>
    ValidarFormularioIngreso();
    ValidarFormularioRegistro();
</script>