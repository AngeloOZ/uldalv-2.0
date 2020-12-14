<?php 
    if(!isset($_SESSION["validarSession"])){
        header("location: login");
        return;
    }else{
        if($_SESSION["validarSession"] != "ok"){
            header("location: login");
            return;
        }
    }
    $usuario = ControladorUsuario::ctrObtenerDatosUser();
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDALV PROJECT</title>
    <link rel="stylesheet" href="<?php echo CSS ?>style.css">

    <!-- SweeAlert -->
    <link rel="stylesheet" href="<?php echo CSS ?>sweetalert2.min.css">
    <script src="<?php echo JS."sweetalert2.all.min" ?>"></script>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/736596057b.js" crossorigin="anonymous"></script>
</head>
<body class="">
    <!-- Menu lateral -->
    <nav class="menu-left">
        <a href="<?php echo URL ?>" class="btn-menu">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="<?php echo URL."tareas" ?>" class="btn-menu">
            <i class="fas fa-tasks"></i>
            <span>Tareas</span>
        </a>
        <a href="tareas" class="btn-menu">
            <i class="fas fa-clipboard"></i>
            <span>Notas</span>
        </a>
        <a href="tareas" class="btn-menu">
            <i class="fas fa-moon"></i>
            <span>Mood Track</span>
        </a>
        <a href="<?php echo URL."enlaces" ?>" class="btn-menu">
            <i class="fas fa-link"></i>
            <span>Enlaces</span>
        </a>
        <a href="logout" class="btn-menu">
            <i class="fas fa-link"></i>
            <span>Cerrar</span>
        </a>
    </nav>
    <!-- Logo -->
    <div class="logo">
    </div>
    <!-- Menu superior -->
    <nav class="menu-up">
        <!-- <form action="" class="buscador">
            <input type="search" name="" id="" placeholder="Buscar">
        </form> -->
        <button class="dark-mode" id="dark-mode">
            <span><i class="fas fa-sun"></i></span>
            <span><i class="fas fa-moon"></i></span>
        </button>
        <div class="notification">
            <i class="far fa-bell"></i>
        </div>
    </nav>
    <!-- Contenedor -->
    <div class="container">
        <?php 
            require_once VIEWS."/module/".$section.".php"; 
        ?>
    </div>

    <div class="modal" id="modal">
        <div class="modal_contenedor">
            <span class="close_modal"><i class="far fa-window-close"></i></span>
            <?php 
                require_once VIEWS."/module/modal.".$section.".php"; 
            ?>
            <button class="cancelar" id="btn_modal_cancel">Cancelar</button>
        </div>
    </div>

    <script src="<?php echo JS.'main.js' ?>"></script>
    <script>
        const body = document.querySelector('body');
        const btnDark = document.getElementById("dark-mode");

        if(localStorage.getItem('status-dark-mode') === 'true'){
            body.classList.add('active-dark')
        }else{
            body.classList.remove('active-dark')
        } 
        btnDark.addEventListener('click', ()=>{
            body.classList.toggle('active-dark')
            if(body.classList.contains('active-dark')){
                localStorage.setItem('status-dark-mode','true')
            }else{
                localStorage.setItem('status-dark-mode','false')
            }
        })
    </script>
    <script src="<?php echo JS."ajaxenlaces.js" ?>"></script>
</body>
</html>