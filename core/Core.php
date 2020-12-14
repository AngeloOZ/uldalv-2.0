<?php
class Core{
    function __construct()
    {
        $this->init();
    }

    private function init(){
        $this->initFunctions();
        // $this->initSession();
        // $this->initAutoload();
    }

    
    private function initFunctions(){
        require_once 'core/configuracion.php';
        require_once 'core/funciones_core.php';
    }

    /*
    * Inicializacion de session del sistema
    */
    private function initSession(){
        if(session_status() == PHP_SESSION_NONE){
            session_set_cookie_params(60*60*24, '/', null, false, true );
            session_name('umbrella');
            session_start();
        }
        return;
    }

    /*
    * Metodo para cargar todos archivos de forma automatica 
    */
    private function initAutoload(){
        require_once CORE.'Autoloader.php';
        Autoloader::init();
        return;
    }

    /*
    * Metodo para cargar plantilla
    */
    public function cargarPlantilla(){
        require_once VIEWS.'plantilla.php';
    }

}