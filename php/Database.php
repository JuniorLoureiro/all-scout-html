<?php
class Database {
    private $host = 'localhost'; // ou o endereço do seu servidor
    private $db_name = 'all_scout'; // nome do seu banco de dados
    private $username = 'root'; // nome de usuário do banco de dados
    private $password = ''; // senha do banco de dados
    public $conn;

    public function __construct() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}