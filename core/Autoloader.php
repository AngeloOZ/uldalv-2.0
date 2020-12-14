<?php
class Autoloader{
    public static function init(){
        spl_autoload_register([__CLASS__,'autoload']);
    }
    private static function autoload($className){
        $className = strtolower($className);

        if(is_file(CORE.$className.'.php')){
            require_once CORE.$className.'.php';
        }elseif(is_file(CONTROLLERS.$className.'.php')){
            require_once CONTROLLERS.$className.'.php';
        }elseif(is_file(MODELS.$className.'.php')){
            require_once MODELS.$className.'.php';
        }
        return;
    }
   
}