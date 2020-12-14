let titleh1 = document.querySelector('h1');
const ctnMain = document.querySelector('.ctn-menu');
const formLogin = document.getElementById("form-login");
const formRegister = document.getElementById("form-register");
const BtnIniciar = document.getElementById("btnIniciar");
const BtnRegistrar = document.getElementById("btnRegistrar");

function RegistrarUser() {
    ctnMain.classList.add('active');
    formLogin.style.left = "-700px";
    formRegister.style.left = "0px";
    BtnRegistrar.classList.add('active-options');
    btnIniciar.classList.remove('active-options');
    titleh1.style.opacity = "0";
    setTimeout(() => {
        titleh1.innerHTML = "Hola bienvenido a UDALV el mejor gestor de tareas"
        titleh1.style.opacity = "1";
        titleh1.style.transition = ".3s ease-in";
    }, 500)
}
function Userlogin() {
    ctnMain.classList.remove('active');
    formLogin.style.left = "0px";
    formRegister.style.left = "700px";
    BtnRegistrar.classList.remove('active-options');
    btnIniciar.classList.add('active-options');
    titleh1.style.opacity = "0";
    setTimeout(() => {
        titleh1.innerHTML = "Planea más facíl, planea más rápido";
        titleh1.style.opacity = "1";
        titleh1.style.transition = ".3s ease-in";
    }, 1000)
}

function ValidarFormularioIngreso() {
    const formIniciar = document.getElementById('form-login');
    const inputIngresarEmail = document.querySelector("#ingresarEmail");
    const inputIngresarPwd = document.querySelector("#ingresarPwd");
    let bandEmail, bandPwd = false;
    const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    const passwordRegex = /^[0-9a-zA-Z@#.$]+$/;


    let formgroup = inputIngresarEmail.parentElement;
    let formgroup2 = inputIngresarPwd.parentElement;

    inputIngresarEmail.addEventListener('change', () => {
        let correo = inputIngresarEmail.value.trim();
        if (emailRegex.test(correo)) {
            bandEmail = true;
            this.MsgWarning(formgroup.querySelector('p'), bandEmail);
            this.LabelValidation(formgroup.querySelector('label'), bandEmail, "");
            this.InputValidation(inputIngresarEmail, bandEmail);
        } else {
            bandEmail = false;
            this.MsgWarning(formgroup.querySelector('p'), bandEmail)
            this.LabelValidation(formgroup.querySelector('label'), bandEmail, "El correo ingresado no es válido");
            this.InputValidation(inputIngresarEmail, bandEmail);
        }
    })
    inputIngresarPwd.addEventListener('change', () => {
        let pws = inputIngresarPwd.value.trim();
        if ((pws.length >= 4 && pws.length <= 20) && passwordRegex.test(pws)) {
            bandPwd = true;
            this.MsgWarning(formgroup2.querySelector('p'), bandPwd);
            this.LabelValidation(formgroup2.querySelector('label'), bandPwd);
            this.InputValidation(inputIngresarPwd, bandPwd);
        } else {
            bandPwd = false;
            this.MsgWarning(formgroup2.querySelector('p'), bandPwd);
            this.LabelValidation(formgroup2.querySelector('label'), bandPwd);
            this.InputValidation(inputIngresarPwd, bandPwd);
        }
    })
    formIniciar.addEventListener('submit', (e) => {
        if (!(bandPwd && bandEmail)) {
            e.preventDefault();
            e.stopPropagation();
            this.MsgWarning(formgroup2.querySelector('p'), bandPwd);
            this.LabelValidation(formgroup2.querySelector('label'), bandPwd);
            this.InputValidation(inputIngresarPwd, bandPwd);
            this.MsgWarning(formgroup.querySelector('p'), bandEmail)
            this.LabelValidation(formgroup.querySelector('label'), bandEmail);
            this.InputValidation(inputIngresarEmail, bandEmail);
        }
    })
}
function ValidarFormularioRegistro() {
    const inputRegistrarNombre = document.querySelector('#registrarNombre');
    const inputRegistrarEmail = document.querySelector('#registrarCorreo');
    const inputRegistrarPassword = document.querySelector('#registrarPwd');
    const inputConfirmPassword = document.querySelector('#confirmPws');
    const inputTerms = document.querySelector('#termsAndConditions');
    //* Expresiones regulares para control de informacion
    const nombreRegex = /^[a-zA-ZáéíóúÁÉÍÓÚÑñ ,]+$/;
    const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    const passwordRegex = /^[0-9a-zA-Z@#.$%&]+$/;
    //* variable bandera
    let bandEmail, bandNombre, bandPass, bandPassCon = false;
    //* Contenedores de los grupos del formilario
    formgroupNombre = inputRegistrarNombre.parentElement;
    formgruoEmail = inputRegistrarEmail.parentElement;
    formgroupPass = inputRegistrarPassword.parentElement;
    formgrupConfirmPass = inputConfirmPassword.parentElement;
    //!Arreglo temporal bug form tab
    inputRegistrarNombre.addEventListener('focus', () => this.RegistrarUser());
    //!Fin del arreglo bug

    //*Validar al perder el foco de los input
    inputRegistrarNombre.addEventListener('change', () => {
        name = inputRegistrarNombre.value.trim();
        if (name.length >= 2 && name.length <= 80) {
            if (nombreRegex.test(name)) {
                bandNombre = true;
                this.MsgWarning(formgroupNombre.querySelector('p'), bandNombre);
                this.InputValidation(inputRegistrarNombre, bandNombre);
                this.LabelValidation(formgroupNombre.querySelector('label'), bandNombre);
            } else {
                formgroupNombre.querySelector('p').innerHTML = "El nombre de no puede contener caracteres especiales";
                this.MsgWarning(formgroupNombre.querySelector('p'), false);
                this.InputValidation(inputRegistrarNombre, false);
                this.LabelValidation(formgroupNombre.querySelector('label'), false);
            }
        } else {
            formgroupNombre.querySelector('p').innerHTML = "La cantidad de caracteres no es válida";
            this.MsgWarning(formgroupNombre.querySelector('p'), false);
            this.InputValidation(inputRegistrarNombre, false);
            this.LabelValidation(formgroupNombre.querySelector('label'), false);
        }
    })
    inputRegistrarEmail.addEventListener('change', () => {
        email = inputRegistrarEmail.value.trim();
        if (!(email.length < 5 || email.length == 0)) {
            if (emailRegex.test(email)) {

                let datos = new FormData();
                datos.append("validarEmail", email);
                let xhr;
                if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
                else xhr = new ActiveXObject("Microsoft.XMLHTTP");
                xhr.open('POST', 'controllers/usuario.controlador.php');
                xhr.addEventListener('load', () => {
                    resultado = (xhr.response);
                    if (resultado == "disponible") {
                        bandEmail = true;
                        this.MsgWarning(formgruoEmail.querySelector('p'), bandEmail);
                        this.InputValidation(inputRegistrarEmail, bandEmail);
                        this.LabelValidation(formgruoEmail.querySelector('label'), bandEmail);
                    } else {
                        bandEmail = false;
                        formgruoEmail.querySelector('p').innerHTML = "Este correo ya esta en uso";
                        this.MsgWarning(formgruoEmail.querySelector('p'), bandEmail);
                        this.LabelValidation(formgruoEmail.querySelector('label', bandEmail));
                        this.InputValidation(inputRegistrarEmail, bandEmail);
                    }
                })
                xhr.send(datos);
            } else {
                bandEmail = false;
                formgruoEmail.querySelector('p').innerHTML = "El correo solo puede contener letras, números, puntos, guiones y guión bajo";
                this.MsgWarning(formgruoEmail.querySelector('p'), bandEmail);
                this.LabelValidation(formgruoEmail.querySelector('label', bandEmail));
                this.InputValidation(inputRegistrarEmail, bandEmail);
            }
        } else {
            bandEmail = false;
            formgruoEmail.querySelector('p').innerHTML = "El correo electónico no es válido o está vacío";
            this.MsgWarning(formgruoEmail.querySelector('p'), bandEmail);
            this.LabelValidation(formgruoEmail.querySelector('label', bandEmail));
            this.InputValidation(inputRegistrarEmail, bandEmail);
        }
    });
    inputRegistrarPassword.addEventListener('change', () => {
        pwd = inputRegistrarPassword.value.trim();
        if ((pwd.length != 0 && (pwd.length >= 4 && pwd.length <= 20))) {
            if (passwordRegex.test(pwd)) {
                bandPass = true;
                this.MsgWarning(formgroupPass.querySelector('p'), bandPass);
                this.LabelValidation(formgroupPass.querySelector('label'), bandPass);
                this.InputValidation(inputRegistrarPassword, bandPass);
            } else {
                bandPass = false;
                formgroupPass.querySelector('p').innerHTML = "La contraseña tiene que ser de 4 a 12 dígitos y no contener caracteres como: <, ?, >, ^, /"
                this.MsgWarning(formgroupPass.querySelector('p'), bandPass);
                this.LabelValidation(formgroupPass.querySelector('label'), bandPass);
                this.InputValidation(inputRegistrarPassword, bandPass);
            }
        } else {
            bandPass = false;
            formgroupPass.querySelector('p').innerHTML = "La contraseña tiene que ser de 4 a 12 dígitos";
            this.MsgWarning(formgroupPass.querySelector('p'), bandPass);
            this.LabelValidation(formgroupPass.querySelector('label'), bandPass);
            this.InputValidation(inputRegistrarPassword, bandPass);
        }
    });
    inputConfirmPassword.addEventListener('change', () => {
        confirmPwd = inputConfirmPassword.value.trim();
        pwd = inputRegistrarPassword.value.trim();
        if (confirmPwd == pwd) {
            bandPassCon = true;
            this.LabelValidation(formgrupConfirmPass.querySelector('label'), bandPassCon);
            this.MsgWarning(formgrupConfirmPass.querySelector('p'), bandPassCon);
            this.InputValidation(inputConfirmPassword, bandPassCon);
        } else {
            bandPassCon = false;
            this.LabelValidation(formgrupConfirmPass.querySelector('label'), bandPassCon);
            this.MsgWarning(formgrupConfirmPass.querySelector('p'), bandPassCon);
            this.InputValidation(inputConfirmPassword, bandPassCon);
        }
    })
    formRegister.addEventListener('submit', (e) => {
        if ((inputTerms.checked) && bandEmail && bandNombre && bandPass && bandPassCon) {
            console.log('se registro');
        } else {
            alert('Debe aceptar los terminos y condiciones');
            e.preventDefault();
            e.stopPropagation();
        }
    })
}

function MsgWarning(parrafo, op) {
    if (op) {
        parrafo.style.display = "none";
    } else {
        parrafo.style.display = "block";
    }
}
function LabelValidation(label, op) {
    if (op) {
        label.style.color = "#28A745";
    } else {
        label.style.color = "#DC3554";
        label.style.top = "-20px";
    }
}
function InputValidation(input, op) {
    if (op) {
        input.style.border = "1px solid #28A745";
    } else {
        input.style.border = "1px solid #DC3554";
    }
}