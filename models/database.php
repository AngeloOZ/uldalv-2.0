<?php
class Conexion{
    private $link;
    private $engine;
    private $host;
    private $name;
    private $user;
    private $pass;
    private $charset;

    /**
     * Constructor para nuestra clase
     */
    public function __construct()
    {
        $this->engine  = LDB_ENGINE;
        $this->name    = LDB_NAME;
        $this->user    = LDB_USER;
        $this->pass    = LDB_PASS;
        $this->charset = LDB_CHARSET;
        return $this;
    }

    /* 
    * Método para abrir una conexión a la base de datos 
    */
    private function connect()
    {
        try {
            $this->link = new PDO(
                $this->engine . ':host=' . $this->host . ';
                dbname=' . $this->name . ';
                charset=' . $this->charset, 
                $this->user, $this->pass);
        
            return $this->link;
            
        } catch (PDOException $e) {
            die(sprintf('No  hay conexión a la base de datos, hubo un error: %s', $e->getMessage()));
        }
    }

    /*
    * Metodo que devuelve la conexión para pripias conexiones
    */
    public static function conectar()
    {
        $self = new self();
        return $self->connect();
    }

    /*
    * Metodo para Buscar un valor en un campo especifico
    */
    public static function unique($tabla, $campo, $dato){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $campo = :$campo");
        $stmt->bindParam(":$campo", $dato);
        if($stmt->execute()){
            return $stmt->rowCount() > 0 ? $stmt : null;
        }else{
            return $stmt->errorInfo();
        }
    }
}
