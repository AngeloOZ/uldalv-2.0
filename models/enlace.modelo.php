<?php
require_once "database.php";

class ModeloEnalce{
    public static function mdlListarEnlaces($tabla, $id, $filtro){
        if($filtro == null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_user = :id ORDER BY 1 desc");

            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return "";
            }
            $stmt = null;
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE (name LIKE :filtro OR link LIKE :filtro) AND id_user = :id");
            $fil = "%$filtro%";
            $stmt->bindParam(":filtro", $fil, PDO::PARAM_STR);
            $stmt->bindParam(":id",$id, PDO::PARAM_STR);

            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return print_r($stmt->errorInfo());
            }
        }
    }
    public static function mdlRegistrarEnlace($tabla, $datos){       
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(name, link, id_user) VALUES(:name, :link, :id_user)");

        $stmt->bindParam(":name", $datos["name"], PDO::PARAM_STMT);
        $stmt->bindParam(":link", $datos["link"], PDO::PARAM_STMT);
        $stmt->bindParam(":id_user", $datos["id_user"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
        $stmt = null;
    }
    public static function mdlActualizarEnalce($tabla, $datos){
        try{
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET name = :name, link = :link WHERE id = :id AND id_user = :id_user");
            $stmt->bindParam(":name", $datos["name"], PDO::PARAM_STMT);            $stmt->bindParam(":link", $datos["link"], PDO::PARAM_STMT);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
            $stmt->bindParam(":id_user", $datos["id_user"], PDO::PARAM_INT);
            if($stmt->execute()){
                return "ok";
            }else{
                return ($stmt->errorInfo());
            }
        }catch(PDOException $e){
            print $e->getMessage();
        }
    }
    public static function mdlEliminarEnlace($tabla, $id){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
    }
    public static function mdlSelecionarEnlaceEspecifico($tabla, $id, $idLink){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :idEnlace AND id_user = :id");

        $stmt->bindParam(":idEnlace", $idLink, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()){
            $cons = $stmt->fetch();
            $datos = array("resp"=>"ok","consulta"=>$cons);
            return $datos;
        }else{
            $datos = array("resp"=>"error","errorInfo"=>$stmt->errorInfo());
            return $datos;
        }
        $stmt = null;   
    }
}