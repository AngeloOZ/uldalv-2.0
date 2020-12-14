<?php
function convertToObject($array){
    if(is_array($array)){
        $json = json_encode($array);
        return json_decode($json);
    }else{
        return null;
    }
}

function print_json($array){
    if(is_array($array)){
        echo json_encode($array);
    }else{
        echo json_encode(["message" => "Formato no válido"]);
    }
}

function message_status_api($code, $messaje, $data = []){
    $array = ["status" => $code, "message" => $messaje];
    if(!empty($data)){
        $array["data"] = $data;
    }
    print_json($array);
}