<?php 
define('METHOD','AES-256-CBC');
define('SECRET_KEY','@U&D#A%L^V20@$20');
define('SECRET_IV','030318');

class Seguridad{
    // public static $tokenName;

    static public function CrearToken($nombre){
        if(!isset($_SESSION["tokenCsrf_".$nombre]) || empty($_SESSION["tokenCsrf_".$nombre])){
            $_SESSION["tokenCsrf_".$nombre] = bin2hex(random_bytes(32));
        }
        return password_hash($_SESSION["tokenCsrf_".$nombre],PASSWORD_DEFAULT);
    }
    static public function VerificarToken($hash, $name){
        $resp = password_verify($_SESSION["tokenCsrf_".$name], $hash);
        return $resp;
    }
    public static function destruirToken($name){
        $_SESSION["tokenCsrf_".$name] = null;
        unset($_SESSION["tokenCsrf_".$name]);
        return "ok";
    }
    public static function encryption($string){
        $output=FALSE;
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }
    public static function decryption($string){
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
}