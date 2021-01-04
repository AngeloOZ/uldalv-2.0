<?php
class ControladorNotas{

    public static function ctrListarNotas(){
        $tabla = "udalv_note";
        $respuesta = ModeloNotas::mdlListarNota($tabla, $_SESSION["idUser"]);
        
        if(!empty($respuesta)){
            echo json_encode($respuesta);
        }else{
            echo json_encode([]);
        }
    }

/* -------------------------------------------------------------------------- */
/*                          Controlador Agregar Notas                         */
/* -------------------------------------------------------------------------- */

    public function ctrAgregarNotas(){
        if(isset($_POST["noteText"])){
            if(!empty($_POST["noteText"])){
                $texto = $_POST["noteText"];
                $tabla = "udalv_note";
                $datos = array(
                    "text" => $texto,
                    "id_user" => $_SESSION["idUser"]
                );

                $respuesta = ModeloNotas::mdlAgregarNota($tabla, $datos);

                if($respuesta == "ok"){
                    AlertaSuccessNotas("La nota se agrego correctamente","Registrado");
                }else{
                    $error = "$respuesta[1]: $respuesta[2]";
                    AlertaErrorNotas($error);
                }
            }else{
                AlertaErrorNotas("No se permite valores vacíos");
            }
        }
    }

    public function ctrActualizarNotas(){
        if(isset($_POST["noteText"])){
            if(!empty($_POST["noteText"]) && !empty($_POST["idNote"])){
                $texto = $_POST["noteText"];
                $tabla = "udalv_note";
                $datos = array(
                    "text" => $texto,
                    "id_user" => $_SESSION["idUser"],
                    "id_note" => $_POST["idNote"]
                );

                $respuesta = ModeloNotas::mdlActualizarNota($tabla, $datos);

                if($respuesta == "ok"){
                    AlertaSuccessNotas("Se actualizo la nota ","Actualizado");
                }else{
                    $err = "$respuesta[1]: $respuesta[2]";
                    AlertaErrorNotas($err);
                }
            }else{
                AlertaErrorNotas("no valores vacios");
            }
        }
    }

    public function ctrEliminarNota(){
        if(isset($_POST["idNota"]) && !empty($_POST["idNota"])){
            $id_note = $_POST["idNota"];
            $tabla = "udalv_note";

            $respuesta = ModeloNotas::mdlEliminarNota($tabla, $id_note, $_SESSION["idUser"]);

            if($respuesta == "ok"){
                AlertaSuccessNotas("Se elimino la nota correctamente","Eliminado");
            }else{
                $error =  "$respuesta[1]: $respuesta[2]";
                AlertaErrorNotas($error);
            }
        }
    }
}

function AlertaErrorNotas($sms){
    $resp = array("RespType"=>"error","sms"=>$sms, "sms2"=>"Oops...");
    echo json_encode($resp);
}
function AlertaSuccessNotas($sms, $sms2){
    $resp = array("RespType"=>"success","sms"=>$sms, "sms2"=>$sms2);
    echo json_encode($resp);
}

if(isset($_POST["operacionEnlace"])){
    session_start();
    require_once "../core/configuracion.php";
    require_once "../models/nota.modelo.php";

    $op = $_POST["operacionEnlace"];
    switch($op){
        case "create":
            $crear = new ControladorNotas();
            $crear->ctrAgregarNotas();
            break;
        case "read":
            echo ControladorNotas::ctrListarNotas(null);
            break;
        case "update":
            $update = new ControladorNotas();
            $update->ctrActualizarNotas();
            break;
        case "delete":
            $eliminar = new ControladorNotas();
            $eliminar->ctrEliminarNota();
            break;
    }
}