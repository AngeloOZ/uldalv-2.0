<?php 
class ControladorEnlace{
    public static function ctrListarEnlace($filtro){
        $id = $_SESSION["idUser"];
        $tabla = "udalv_url";
        if($filtro == null){
            $enlaces = ModeloEnalce::mdlListarEnlaces($tabla, $id, null);
        }else{
            $enlaces = ModeloEnalce::mdlListarEnlaces($tabla, $id, $filtro);
        }
        if(!empty($enlaces)){
            if(count($enlaces) > 0){
                return json_encode($enlaces);
            }else{
                return json_encode([]);
            }
        }else{
            return json_encode([]);
        }
    }
    public function ctrRegistratEnlace(){
        if(isset($_POST["ingresarNombreEnlace"])){
            $nombreEnlace = filtrarInput($_POST["ingresarNombreEnlace"]);
            $url = filter_var($_POST["ingresarUrl"], FILTER_SANITIZE_URL);
            $idUser = $_SESSION["idUser"];

            if(!empty($nombreEnlace) && !empty($url) && !empty($idUser)){
                if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ ,.-_=+%$#@!?¿¡)(]+$/',$nombreEnlace) &&
                   filter_var($url, FILTER_VALIDATE_URL)
                ){
                    $tabla = "udalv_url";
                    $datos = array(
                        "name" => $nombreEnlace, 
                        "link" => $url,
                        "id_user" => $idUser
                    );
                    $respuesta = ModeloEnalce::mdlRegistrarEnlace($tabla, $datos);
                    if($respuesta == "ok"){
                        AlertaSuccess("Se registro el enlace correctamente","Registrado!");
                    }else{
                        $error = "Hubo errores de Conexión: $respuesta[1]: $respuesta[2]";
                        AlertaError($error);
                    }
                }else{
                    AlertaError("Algunos caracteres especiales no son permitidos (<, >, /, |, \)");
                }
            }else{
                AlertaError("Todos los campos son requeridos");
            }   
        }
    }
    public function ctrEditarEnlace(){
        if(isset($_POST["ingresarNombreEnlace"])){
            $nombreEnlace = filtrarInput($_POST["ingresarNombreEnlace"]);
            $url = filter_var($_POST["ingresarUrl"], FILTER_SANITIZE_URL);
            $idEnlace = $_POST["hiddenIdLink"];

            if(!empty($nombreEnlace) && !empty($url) && !empty($idEnlace)){
                if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ ,.-_=+%$#@!?¿¡)(]+$/',$nombreEnlace) && filter_var($url, FILTER_VALIDATE_URL)
                ){
                    $tabla = "udalv_url";
                    $idUser = $_SESSION["idUser"];

                    $comprobacionDatos = ModeloEnalce::mdlSelecionarEnlaceEspecifico($tabla,$idUser, $idEnlace);

                    $datos = array(
                        "id" => $idEnlace,
                        "name" => $nombreEnlace, 
                        "link" => $url,
                        "id_user" => $idUser
                    );

                    if($comprobacionDatos["resp"] == "ok" && !empty($comprobacionDatos["consulta"])){
                        $respuesta = ModeloEnalce::mdlActualizarEnalce($tabla, $datos);
                        if($respuesta == "ok"){
                            AlertaSuccess("Su enlace fue actualizado correctamente","Actualizado!");
                        }else{
                            $error = "Hubo errores de conexion: $respuesta[1]: $respuesta[2]";
                            AlertaError($error);
                        }
                    }else{
                        AlertaError("Parece que hubo un error, intentalo más tarde");
                    }
                }else{
                    AlertaError("Algunos caracteres especiales no son permitidos (<, >, /, |, \)");
                }
            }else{
                AlertaError("Todos los campos son requeridos");
            }   
        }
    }
    public function ctrEliminarEnlace(){
        if(isset($_POST["idEnlaceDelete"])){
            $tabla = "udalv_url";
            $id = $_POST["idEnlaceDelete"];
            $respuesta = ModeloEnalce::mdlEliminarEnlace($tabla, $id);
            if($respuesta == "ok"){
                AlertaSuccess("Su enlace ha sido eliminado","Eliminado!");
            }else{
                $error = "Hubo errores de conexion: $respuesta[1]: $respuesta[2]";
                AlertaError($error);
            }
        }
    }
}
function filtrarInput($text){
    return htmlspecialchars(trim($text),ENT_QUOTES, 'UTF-8');
}
function AlertaError($sms){
    $resp = array("RespType"=>"error","sms"=>$sms, "sms2"=>"Oops...");
    echo json_encode($resp);
}
function AlertaSuccess($sms, $sms2){
    $resp = array("RespType"=>"success","sms"=>$sms, "sms2"=>$sms2);
    echo json_encode($resp);
}


if(isset($_POST['operacionEnlace']) && !empty($_POST['operacionEnlace'])){
    session_start();
    require_once "../core/configuracion.php";
    require_once "../models/enlace.modelo.php";
    
    $operacion = $_POST['operacionEnlace'];
    $filter = null;

    if(isset($_POST['FilterSearch'])){
        $filter = $_POST['FilterSearch'];
    }
    
    switch($operacion){
        case 'read':
            echo  ControladorEnlace::ctrListarEnlace($filter);
            break;
        case 'create':
            $add = new ControladorEnlace();
            $add->ctrRegistratEnlace();
            break;
        case 'update':
            $update = new ControladorEnlace();
            $update->ctrEditarEnlace();
            break;
        case 'delete':
            $delete = new ControladorEnlace();
            $delete->ctrEliminarEnlace();
            break;
    }       
}
