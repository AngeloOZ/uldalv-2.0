<?php
require_once "database.php";

class ModeloTareas{
    
    public static function mdlListarTarea($tabla, $id, $filtro){
        if($filtro == null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_user = :id ORDER BY 4 desc");

            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    
            if($stmt->execute()){
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return "";
            }
            $stmt = null;
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE (name LIKE :filtro OR icon LIKE :filtro OR link LIKE :filtro) AND id_user = :id");
            $fil = "%$filtro%";
            $stmt->bindParam(":filtro", $fil, PDO::PARAM_STR);
            $stmt->bindParam(":id",$id, PDO::PARAM_STR);

            if($stmt->execute()){
                return $stmt->fetchAll();
            }else{
                return print_r($stmt->errorInfo());
            }
        }
    }
    
    public static function mdlAgregarTarea($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(name_task, description, date, state_task,id_user) VALUES(:name_task, :description, :date, :state_task, :id)");
        
        $stmt->bindParam(":name_task",$datos["name_task"],PDO::PARAM_STR);
        $stmt->bindParam(":description",$datos["description"],PDO::PARAM_STR);
        $stmt->bindParam(":date",$datos["date"],PDO::PARAM_STR);
        $stmt->bindParam(":state_task",$datos["state_task"],PDO::PARAM_STR);
        $stmt->bindParam(":id",$datos["id_user"],PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
        $stmt = null;
    }

    //Actualizar
    public static function mdlActualizarTarea($tabla, $datos){
        try{
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET name_task = :name_task, description = :description, date = :date WHERE id = :id_task AND id_user = :id_user");
            
            $stmt->bindParam(":name_task", $datos["name_task"], PDO::PARAM_STR);
            $stmt->bindParam(":description",$datos["description"],PDO::PARAM_STR);
            $stmt->bindParam(":date", $datos["date"], PDO::PARAM_STR);
            $stmt->bindParam(":id_task", $datos["id_task"], PDO::PARAM_INT);
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

    public static function mdlUpdateState($tabla, $id, $state){
        try{
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET state_task = :state_task  WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":state_task", $state, PDO::PARAM_BOOL);

            if($stmt->execute()){
                return "ok";
            }else{
                return $stmt->errorInfo();
            }
        }
        catch(PDOException $e){
            print $e->getMessage();
        }
    }

    public static function mdlEliminarTarea($tabla, $id_task, $id_user){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id_task AND id_user = :id_user");

        $stmt->bindParam(":id_task", $id_task, PDO::PARAM_INT);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        
        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
    }

}