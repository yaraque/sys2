<?php
class Conexion {
    private $hostname = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "nuevohorizonte";
    private $conn;

    public function conectar() {
        $this->conn = new mysqli($this->hostname, $this->user, $this->password, $this->database);

        if ($this->conn->connect_error) {
            echo "<script>alert('Error de conexión: " . addslashes($this->conn->connect_error) . "');</script>";
            return false;
        } else {
            //echo "<script>alert('Conexión exitosa a la base de datos');</script>";
            return true;
        }
    }

    public function getConexion() {
        if (!$this->conn) {
            $this->conectar();
        }
        return $this->conn;
    }

    public function desconectar() {
        if ($this->conn) {
            $this->conn->close();
            // echo "<script>alert('Conexión cerrada');</script>";
        }
    }
}

$nuevohorizonte = new Conexion();
$nuevohorizonte->conectar();

?>