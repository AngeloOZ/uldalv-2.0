<?php 
/*
* Definir el TimeZone del sistema
*/
date_default_timezone_set('America/Guayaquil');

/* 
* Definir el lenguaje 
*/
define('LANG', 'es');

/* 
* Puerto y la URL del sitio
*/

define('URL','http://localhost/udalvpro/');

/*
* Direcciones de base
*/
define('PATH','');
define('CORE','core/');
define('CONTROLLERS','controllers/');
define('MODELS','models/');
define('VIEWS','views/');
define('ASSETS', URL.'assets/');
define('CSS', ASSETS.'css/');
define('JS', ASSETS.'js/');
define('IMG', ASSETS.'img/');

/*
* Credenciales de base de datos 
*/
define('LDB_ENGINE', 'mysql');
define('LDB_HOST', 'localhost');
define('LDB_NAME', 'bdd_udalv');
define('LDB_USER', 'root');
define('LDB_PASS', '');
define('LDB_CHARSET', 'utf8');

/*
* Configuracion de correo nivel temporal
*/
define('EMAIL_SENDER', 'Sistema de Reservación');
define('EMAIL_USER', 'mysqlremote123@gmail.com');
define('EMAIL_PASSWORD', 'Milena200');
define('EMAIL_HOST', 'smtp.gmail.com');
define('EMAIL_PORT', '587');