<?php 
require_once 'core/Core.php';

require_once "models/usuario.modelo.php";


require_once 'controllers/security.controlador.php';
require_once 'controllers/usuario.controlador.php';

$core = new Core();

$core->cargarPlantilla();