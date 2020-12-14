<?php 
require_once "database.php";

class ModeloUsuario{

//* -------------------------------------------------------------------------- */
//?                        Modelos Seleccionar Registro                        */
//* -------------------------------------------------------------------------- */

    static public function mdlObtenerUsuarios($tabla, $columna = null, $datos = null){
        if($columna == null && $datos == null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            if($stmt->execute()){
                return ($stmt->fetchAll());
            }else{
                return ($stmt->errorInfo());
            }
            $stmt = null;
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $columna = :$columna");

            $stmt->bindParam(":".$columna, $datos, PDO::PARAM_STR);

            if($stmt->execute()){
                return ($stmt->fetch());
            }else{
                return ($stmt->errorInfo());
            }
            $stmt = null;
        }
    }
//* -------------------------------------------------------------------------- */
//?                          Modelos Registrar Usuario                         */
//* -------------------------------------------------------------------------- */
    public static function create($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(email, name, lastname, password, avatar, birthday, user_complete, create_at) VALUES (:email, :name, :lastname, :password, :avatar, :birthday, :user_complete, :create_at)");

        $stmt->bindParam(":email", $datos['email']);
        $stmt->bindParam(":name", $datos['name']);
        $stmt->bindParam(":lastname", $datos['lastname']);
        $stmt->bindParam(":password", $datos['password']);
        $stmt->bindParam(":avatar", $datos['avatar']);
        $stmt->bindParam(":birthday", $datos['birthday']);
        $stmt->bindParam(":birthday", $datos['birthday']);
        $stmt->bindParam(":user_complete", $datos['user_complete']);
        $stmt->bindParam(":create_at", $datos['create_at']);
        
        if($stmt-> execute()){
            return "ok";
        }else{
            return $stmt->errorInfo();
        }
    }
//* -------------------------------------------------------------------------- */
//?                          Modelos Registrar Usuario                         */
//* -------------------------------------------------------------------------- */
    public static function mdlEditarInformacionUsuario($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET name = :name, lastname = :lastname, avatar = :avatar, birthday = :date WHERE id = :id");

        $stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);
        $stmt->bindParam(":name", $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $datos['apellido'], PDO::PARAM_STR);
        $stmt->bindParam(":avatar", $datos['avatar'], PDO::PARAM_STR);
        $stmt->bindParam(":date", $datos['fecha'], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return ($stmt->errorInfo());
        }
        $stmt = null;
    }

    public static function ctrEditarPassword($tabla ,$id, $pass){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET password = :pass WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":pass", $pass, PDO::PARAM_STR);

        if($stmt->execute()){
            $datos = $stmt->fetch();
            $info = array("state"=>"ok", "info"=>$datos);
            return $info;
        }else{
            $info = array("state"=>"error", "info" => $stmt->errorInfo());
            return $info;
        }
    }
}