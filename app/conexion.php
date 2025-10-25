<?php
class Conexion {
    private $hostname = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "nuevohorizonte";
    private $conn;
    private static $instancia = null;

    // Patrón Singleton para una única instancia
    public static function getInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new Conexion();
        }
        return self::$instancia;
    }

    // Constructor privado para evitar múltiples instancias
    private function __construct() {
        $this->conectar();
    }

    private function conectar() {
        try {
            $this->conn = new mysqli($this->hostname, $this->user, $this->password, $this->database);
            
            if ($this->conn->connect_error) {
                throw new Exception("Error de conexión: " . $this->conn->connect_error);
            }
            
            // Configurar charset
            $this->conn->set_charset("utf8");
            
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception("Error al conectar con la base de datos");
        }
    }

    public function getConexion() {
        // Verificar si la conexión está activa
        if (!$this->conn || !$this->conn->ping()) {
            $this->conectar();
        }
        return $this->conn;
    }

    public function desconectar() {
        if ($this->conn) {
            $this->conn->close();
            $this->conn = null;
        }
    }

    // Evitar clonación
    private function __clone() {}
    
    // Evitar serialización
    public function __wakeup() {}
}
?>