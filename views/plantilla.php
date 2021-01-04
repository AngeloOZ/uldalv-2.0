<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

<?php
session_set_cookie_params(60*60*24, '/', null, false, true );
session_start();


if(isset($_GET['url']) && !empty($_GET['url'])){
    $url = explode('/',$_GET['url']);
    $white_list_url = ['login','logout','home','tareas','enlaces','notas','mood'];
    if(in_array($url[0], $white_list_url)){
        if($url[0] == "login" || $url[0] == "logout"){
            require_once 'view/'.$url[0].'.php';
            return;
        }
        $section = $url[0];
        require_once 'view/index.php';
    }else{
        $section = "404";
        require_once 'view/index.php';
    }

}else{
    $section = "home";
    require_once 'view/index.php';
}