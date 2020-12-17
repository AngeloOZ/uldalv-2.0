<?php
class ControladorTareas{

    public static function ctrListarTask($filtro){
        $id = $_SESSION['idUser'];
        $tabla = "udalv_task";
        $respuesta = ModeloTareas::mdlListarTarea($tabla, $id, null);
        
        if(!empty($respuesta)){
            echo json_encode($respuesta);
        }else{
            echo json_encode([]);
        }
    }

    public function ctrUpdateStateTask(){
        if(isset($_POST["state_task"])){
            $id = intval($_POST["id_task"]);
            $state = boolval($_POST["state_task"]);

            if(is_numeric($id) && is_bool($state)){
                $tabla = "udalv_task";
                $respuesta = ModeloTareas::mdlUpdateState($tabla, $id, $state);
                if(!empty($respuesta)){
                    echo "ok";
                }else{
                    var_dump($respuesta);
                }
            }else{
                echo "error";
            }
        }
    }

    public function ctrAgregarTask(){
        if(isset($_POST["nombreTarea"])){
            if(!empty($_POST["nombreTarea"]) && !empty($_POST["fecha"])){
                $nombre = htmlspecialchars($_POST["nombreTarea"]);
                $description = htmlspecialchars($_POST["descripcionTarea"]);
                $fecha = htmlspecialchars($_POST["fecha"]);
                $datos = array(
                    "name_task" => $nombre,
                    "description" => $description,
                    "date" => $fecha,
                    "state_task" => false,
                    "id_user" => $_SESSION["idUser"]
                );

                $tabla = "udalv_task";
                $respuesta = ModeloTareas::mdlAgregarTarea($tabla, $datos);
                if($respuesta == "ok"){
                    AlertaSuccessTask("La tarea se agrego correctamente","Registrado");
                }else{
                    $error = "$respuesta[1]: $respuesta[2]";
                    AlertaErrorTask($error);
                }
            }else{
                AlertaErrorTask("No se permite valores vacíos");
            }
        }
    }

    public function ctrActualizarTask(){
        if(isset($_POST["fecha"])){
            if(!empty($_POST["nombreTarea"]) && !empty($_POST["fecha"]) && !empty($_POST["inputIdTareas"])){
                $id_task = htmlspecialchars($_POST["inputIdTareas"]);
                $description = htmlspecialchars($_POST["descripcionTarea"]);
                $nombre = htmlspecialchars($_POST["nombreTarea"]);
                $fecha = htmlspecialchars($_POST["fecha"]);


                $tabla = "udalv_task";
                $datos = array(
                    "id_task" => $id_task,
                    "name_task" => $nombre,
                    "description" => $description,
                    "date" => $fecha,
                    "id_user" => $_SESSION["idUser"]
                );

                $respuesta = ModeloTareas::mdlActualizarTarea($tabla, $datos);
                if($respuesta == "ok"){
                    AlertaSuccessTask("Se actualizo la tarea ","Actualizado");
                }else{
                    $err = "$respuesta[1]: $respuesta[2]";
                    AlertaErrorTask($err);
                }
            }else{
                AlertaErrorTask("no valores vacios");
            }
        }
    }

    public function ctrEliminarTask(){
        if(isset($_POST["idTask"]) && !empty($_POST["idTask"])){
            $tabla = "udalv_task";
            $id =$_POST["idTask"];
            $respuesta = ModeloTareas::mdlEliminarTarea($tabla, $id, $_SESSION["idUser"]);

            if($respuesta == "ok"){
                AlertaSuccessTask("Se elimino la tarea correctamente","Eliminado");
            }else{
                $error =  "$respuesta[1]: $respuesta[2]";
                AlertaErrorTask($error);
            }
        }
    }
}

function AlertaErrorTask($sms){
    $resp = array("RespType"=>"error","sms"=>$sms, "sms2"=>"Oops...");
    echo json_encode($resp);
}
function AlertaSuccessTask($sms, $sms2){
    $resp = array("RespType"=>"success","sms"=>$sms, "sms2"=>$sms2);
    echo json_encode($resp);
}

if(isset($_POST["operacionEnlace"])){
    session_start();
    require_once "../core/configuracion.php";
    require_once "../models/tareas.modelo.php";

    $op = $_POST["operacionEnlace"];

    switch($op){
        case "create":
            $crear = new ControladorTareas();
            $crear->ctrAgregarTask();
            break;
        case "read":
            echo ControladorTareas::ctrListarTask(null);
            break;
        case "update":
            $delete = new ControladorTareas();
            $delete->ctrActualizarTask();
            break;
        case "delete":
            $eliminar = new ControladorTareas();
            $eliminar->ctrEliminarTask();
            break;
        case "update_state":
            $state = new ControladorTareas();
            $state->ctrUpdateStateTask();
            break;
    }
}
