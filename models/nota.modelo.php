<?php
require_once "database.php";

class ModeloNotas{
    
    public static function mdlListarNota($tabla, $id){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_user = :id ORDER BY 1 desc");

            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    
            if($stmt->execute()){
                return $stmt->fetchAll();
            }else{
                return "";
            }
            $stmt = null;
    }
    
    public static function mdlAgregarNota($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(text, update_at, id_user) VALUES(:text, NOW(), :id_user)");

        $stmt->bindParam(":text",$datos["text"],PDO::PARAM_STR);
        $stmt->bindParam(":id_user", $datos["id_user"],PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
        $stmt = null;
    }

    public static function mdlActualizarNota($tabla, $datos){
        try{
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET text = :text, update_at = NOW() WHERE id = :id_note AND id_user = :id_user");

            $stmt->bindParam(":text", $datos["text"], PDO::PARAM_STR);
            $stmt->bindParam(":id_note", $datos["id_note"], PDO::PARAM_INT);
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
    public static function mdlEliminarNota($tabla, $id_note, $id_user){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id_note AND id_user = :id_user");

        $stmt->bindParam(":id_note", $id_note, PDO::PARAM_INT);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        
        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
    }

}